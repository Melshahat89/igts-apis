<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Orders\AddRequestOrders;
use App\Application\Requests\Admin\Orders\UpdateRequestOrders;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\OrderssDataTable;
use App\Application\Model\Orders;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Certificatescontainer;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\Log;
use App\Application\Model\Ordersposition;
use App\Application\Model\Payments;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\Transactions;
use App\Application\Model\User;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Http\Request as HttpRequest;

class OrdersController extends AbstractController
{
    public function __construct(Orders $model)
    {
        parent::__construct($model);
    }

    public function index(OrderssDataTable $dataTable)
    {
        $data['ordersCount'] = Orders::where('status', Orders::STATUS_SUCCEEDED)->count();
        $data['freeOrdersCount'] = Orders::where('status', Orders::STATUS_SUCCEEDED)->whereHas('payments', function($query){
            $query->where('amount', 0);
        })->count();
        $data['revenue'] = DB::table('orders')->join('payments', 'orders.payments_id', '=', 'payments.id')->select('orders.id', 'orders.payments_id', 'payments.amount')->get()->sum('amount');
        $data['usersCount'] = User::count();

        if(isset($_GET['from']) && isset($_GET['to'])){
            $from = $_GET['from'];
            $to = $_GET['to'];


            $data['ordersCount'] = Orders::where('status', Orders::STATUS_SUCCEEDED)->whereBetween('updated_at', [$from, $to])->count();
            $data['freeOrdersCount'] = Orders::where('status', Orders::STATUS_SUCCEEDED)->whereHas('payments', function($query){
                $query->where('amount', 0);
            })->whereBetween('updated_at', [$from, $to])->count();

            $data['revenue'] = DB::table('orders')->join('payments', 'orders.payments_id', '=', 'payments.id')->select('orders.id', 'orders.payments_id', 'payments.amount')->whereBetween('orders.updated_at', [$from, $to])->get()->sum('amount');

            $data['usersCount'] = User::whereBetween('updated_at', [$from, $to])->count();
        }
        return $dataTable->render('admin.orders.index', ['data' => $data]);
    }

    public function show($id = null)
    {
        $order = Orders::find($id);
        if($order && Auth::user()->id != $order->emp_id && Auth::user()->group_id != 1 && Auth::user()->group_id != 9){

            alert()->error(trans('orders.You do not have permission to view this order'));
            return redirect()->back();
        }
        
        if($order && $order->status == Orders::STATUS_SUCCEEDED){
            alert()->error(trans('orders.You do not have permission to view this order'));
            return redirect()->back();
        }

        return $this->createOrEdit('admin.orders.edit', $id);
    }

    public function store(AddRequestOrders $request)
    {
        $currency = $request->get('currency');
        $installment = $request->get('installment');
        
        $order = new Orders();
        $order->status = Orders::STATUS_OFFLINE_DIRECTPAY;
        $order->emp_id = Auth::user()->id;
        $order->user_id = $request->get('user_id');
        $order->type = Orders::TYPE_OFFLINE;
        $courseIndex = 0;

        if($order->save()){

            if($request->has('certificates')){
                foreach($request->get('certificates') as $certificate){
                    $certificateContainer = Certificatescontainer::findOrFail($certificate);
                    $cost = round($request->get('certificates-cost') / sizeof($request->get('certificates')));
                    $orderPosition = new Ordersposition();
                    $orderPosition->amount = $cost;
                    $orderPosition->currency = $currency;
                    $orderPosition->certificate_id = $certificateContainer->certificate_id;
                    $orderPosition->orders_id = $order->id;
                    $orderPosition->courses_id = $certificateContainer->courses_id;
                    $orderPosition->user_id = $request->get('user_id');
                    $orderPosition->type = Ordersposition::TYPE_CERTIFICATE;
                    $orderPosition->save();
                }
            }

            if($request->has('courses')){
                foreach($request->get('courses') as $course){
                    $cost = $request->get('coursesCost')[$courseIndex];
                    $orderPosition = new Ordersposition();
                    $orderPosition->amount = $cost;
                    $orderPosition->currency = $currency;
                    $orderPosition->orders_id = $order->id;
                    $orderPosition->courses_id = $course;
                    $orderPosition->user_id = $request->get('user_id');
                    $orderPosition->type = Ordersposition::TYPE_Course;
                    $orderPosition->save();
                    $courseIndex++;
                }
            }

            $payment = new Payments();
            $payment->operation = Payments::OPERATION_DEPOSIT;
            $payment->amount = $request->get('grand-total');
            $payment->status = Payments::STATUS_PENDING;
            $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
            $payment->user_id = $request->get('user_id');
            $payment->orders_id = $order->id;
            $payment->save();

            $order->payments_id = $payment->id;
            $order->save();

            alert()->success(trans('website.Success'), trans('orders.Successfully Created Order'));
            return redirect()->to('/lazyadmin/orders');
        }

        alert()->error(trans('admin.Error'), trans('orders.Failed To Create Order'));
        return redirect()->back();
    }

    public function update($id, UpdateRequestOrders $request)
    {
        $order = Orders::findOrFail($id);
        $currency = $request->get('currency');

        /////// DELETE EXISTING ORDER POSITIONS AND PAYMENT \\\\\\\\
        foreach($order->ordersposition as $orderPosition){
            $orderPosition->delete();
        }
        if(isset($order->payments)){
            $order->payments->delete();
        }

        $courseIndex = 0;

        if($request->has('certificates')){
            foreach($request->get('certificates') as $certificate){
                $certificateContainer = Certificatescontainer::findOrFail($certificate);
                $cost = round($request->get('certificates-cost') / sizeof($request->get('certificates')));
                $orderPosition = new Ordersposition();
                $orderPosition->amount = $cost;
                $orderPosition->currency = $currency;
                $orderPosition->certificate_id = $certificateContainer->certificate_id;
                $orderPosition->orders_id = $order->id;
                $orderPosition->courses_id = $certificateContainer->courses_id;
                $orderPosition->user_id = $request->get('user_id');
                $orderPosition->type = Ordersposition::TYPE_CERTIFICATE;
                $orderPosition->save();
            }
        }

        if($request->has('courses')){
            foreach($request->get('courses') as $course){
                $cost = $request->get('coursesCost')[$courseIndex];
                $orderPosition = new Ordersposition();
                $orderPosition->amount = $cost;
                $orderPosition->currency = $currency;
                $orderPosition->orders_id = $order->id;
                $orderPosition->courses_id = $course;
                $orderPosition->user_id = $request->get('user_id');
                $orderPosition->type = Ordersposition::TYPE_Course;
                $orderPosition->save();
                $courseIndex++;
            }
        }

        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = $request->get('grand-total');
        $payment->status = Payments::STATUS_PENDING;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = $request->get('user_id');
        $payment->orders_id = $order->id;
        $payment->save();

        $order->payments_id = $payment->id;
        $order->user_id = $request->get('user_id');
        $order->save();

        alert()->success(trans('website.Success'), trans('orders.Successfully Created Order'));
        return redirect()->to('/lazyadmin/orders');
    }


    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.orders.show', $id, ['fields' =>  $fields]);
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        if(Auth::user()->id != $order->emp_id && Auth::user()->group_id != 1 && Auth::user()->group_id != 9){
            alert()->error(trans('orders.You do not have permission to delete this order'));
            return redirect()->back();
        }
        
        if($order && $order->status == Orders::STATUS_SUCCEEDED && Auth::user()->group_id != 1){
            alert()->error(trans('orders.You do not have permission to delete this order'));
            return redirect()->back();
        }

        return $this->deleteItem($id, 'lazyadmin/orders')->with('sucess', 'Done Delete orders From system');
    
    }

    public function pluck(\Illuminate\Http\Request $request)
    {
        return $this->deleteItem($request->id, 'lazyadmin/orders')->with('sucess', 'Done Delete orders From system');
    }

    public function enrollnow($orderID)
    {
        //            Parameters

        $order = Orders::findOrFail($orderID);
        $user = User::findOrFail($order->user_id);

        $currency =  (isset($order['ordersposition'][0]['currency'])) ? $order['ordersposition'][0]['currency'] : "";
        $amount = Ordersposition::where('orders_id',$order->id)->sum('amount');
        $amount_cents = ceil($amount) * 100;
        $source_data_type =  "Vodafone";
        $source_data_sub_type = "Vodafone";
        $success = 'true';
        $data_message = 'Vodafone cashe from admin';
        $hmac = '';
        $getOrder ='';
        


        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = $user->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $orderID;


        // Set the error flag to false
        $errorExists = false;

        if ($success == 'true') {
            $payment->status = Payments::STATUS_SUCCEEDED;
        } else {
            $payment->status = Payments::STATUS_FAILED;
        }

        // Payment Data
        $payment->accept_hmac = $hmac;
        $payment->accept_source_data_sub_type = $source_data_sub_type;
        $payment->accept_data_message = $data_message;
        $payment->accept_success = $success;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $getOrder;
        $payment->accept_source_data_type = $source_data_type;

        //Save the order
        if ($payment->save()) {
            
            $promoRow = null;

            if($order && $order->status != Orders::STATUS_DIRECTBUY && $payment->status == Payments::STATUS_SUCCEEDED){
    
                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order);
                $promoCode = getCurrentPromoCode();
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;
                    
    
                }
                
                foreach($itemsArr as $key => $values){
                
                    switch($key){
    
                        case 'courses': 
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $order->user_id);
                            }
                        break;
    
                        case 'certificates':
                            foreach($values as $value){
                                enrollCertificate($value->courses_id, $value->certificate_id, $order->user_id);
                            }
                        break;

                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $order->user_id);
                            }
                        break;

                        default:
                    }
                }     
    
    
                // Make sure the instructors and affiliates get their transactions only once
                if ($order->status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Courses::TYPE_COURSE || $orderPosition->type == Courses::TYPE_BUNDLES || $orderPosition->type == Courses::TYPE_MASTERS || $orderPosition->type == Courses::TYPE_DIPLOMAS) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;
    
                            if(getCurrency() == 'USD'){
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
                                $amount_cents = round($exchangeRate * $amount_cents);
    
                                $course_price = round($exchangeRate * $course_price);
                            }
                            
                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){
    
                                setInstructorAffTransactions($course, $course_price, $payment, $promoRow);
    
                            }else{
    
                                setInstructorAffTransactions($course, $course_price, $payment);
    
                            }
    
    
                        }elseif ($orderPosition->type == Ordersposition::TYPE_Event) {    //Event
    
    
                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;
    
                            if (getCurrency() == 'USD') {
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
                                $amount_cents = round($exchangeRate * $amount_cents);
    
                                $event_price = round($exchangeRate * $event_price);
                            }
    
    
    
                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){
    
                                distEventTransactions($event, $event_price, $payment, $promoRow);
    
                            }else{
    
                                distEventTransactions($event, $event_price, $payment);
    
                            }
    
                        }
                    }
    
                    // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);
    
                }
    
            }
        }

        // Link the order with the payement:
        $order->status =  Orders::STATUS_SUCCEEDED;
        $order->payments_id = $payment->id;
        
        if($order->save()){
            //Check if applied promo code and make use of it:

            if($promoRow){
                
                connectPromoWithOrder($promoRow, $order->id);

            }
        }


        alert()->success(trans('website.Success'), trans('website.Success'));

        $logs = new Log();
        $logs->action = "Enroll Vodafone Cash Order";
        $logs->model = "orders";
        $logs->status = "Success";
        $logs->messages = "Enrolled";
        $logs->user_id = Auth::user()->id;
        $logs->save();

        return redirect()->back();

    }

    public function addNewCourseItem(){

        return allCoursesSelect();
    }

    public function addNewCertificateItem(){
        return allCertificatesSelect();

    }

    public function approveOfflineOrder($id){
        
        $order = Orders::findOrFail($id);
        $payment = $order->payments;
        $currencyID = $payment->currency_id;
        $userID = $order->user_id;
        $user = User::findOrFail($userID);
        $itemsArr = extractOrderItemTypes($order);
        
        foreach($itemsArr as $key => $values){
                
            switch($key){

                case 'courses': 
                    foreach($values as $value){
                        $course = Courses::findOrFail($value->courses_id);
                        enrollCourse($value->courses_id, $userID);
                        $course_price = $value->amount;
                        if($currencyID == 2){
                            //get Exchange rate
                            $exchangeRate = Payments::exchangeRate();
                            $course_price = round($exchangeRate * $value->amount);
                        }

                        setInstructorAffTransactions($course, $course_price, $payment);
                    }
                break;

                case 'certificates':
                    foreach($values as $value){
                        enrollCertificate($value->courses_id, $value->certificate_id, $userID);
                    }
                break;

                case 'events':
                    foreach($values as $value){
                        enrollEvent($value->events_id, $userID);
                    }
                break;

                default:
            }
        }   

        $order->status = Orders::STATUS_SUCCEEDED;
        $payment->status = Payments::STATUS_SUCCEEDED;
        $order->save();
        $payment->save();

        Mail::to($user->email)->send(new OrderConfirm($order, $user, $payment->amount));
        User::addNotification([$userID], trans('messages.notificationPurchaseTitle'), trans('messages.notificationPurchaseDescription'), '/account/myCourses');

        $logs = new Log();
        $logs->action = "Approve Order";
        $logs->model = "Orders";
        $logs->status = "Success";
        $logs->messages = $order->id;
        $logs->user_id = Auth::user()->id;
        $logs->save();
        
        alert()->success(trans('website.Success'), trans('orders.Successfully Approved Order'));
        return redirect()->back();
        
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //check if exist code
        $code = Eventstickets::where('code',$randomString)->first();
            if($code){
                $this->generateRandomString($length);
            }

        return $randomString;
    }
}
