<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Payments;
use App\Application\Model\Orders;
use App\Application\Model\Courses;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Events;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Ordersposition;
use App\Application\Model\PaypalPaymentsIntegration;
use App\Application\Model\PostAffiliateProIntegration;
use App\Application\Model\Transactions;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Application\Requests\Website\Payments\AddRequestPayments;
use App\Application\Requests\Website\Payments\UpdateRequestPayments;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;

class PaymentsController extends AbstractController
{

     public function __construct(Payments $model)
     {
        parent::__construct($model);
     }

     public function index(){
        $items = $this->model;

        if(request()->has('from') && request()->get('from') != ''){
            $items = $items->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $items = $items->whereDate('created_at' , '<=' , request()->get('to'));
        }

			if(request()->has("operation") && request()->get("operation") != ""){
				$items = $items->where("operation","=", request()->get("operation"));
			}

			if(request()->has("amount") && request()->get("amount") != ""){
				$items = $items->where("amount","=", request()->get("amount"));
			}

			if(request()->has("currency_id") && request()->get("currency_id") != ""){
				$items = $items->where("currency_id","=", request()->get("currency_id"));
			}

			if(request()->has("receiver_id") && request()->get("receiver_id") != ""){
				$items = $items->where("receiver_id","=", request()->get("receiver_id"));
			}

			if(request()->has("token") && request()->get("token") != ""){
				$items = $items->where("token","=", request()->get("token"));
			}

			if(request()->has("token_date") && request()->get("token_date") != ""){
				$items = $items->where("token_date","=", request()->get("token_date"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("accept_source_data_type") && request()->get("accept_source_data_type") != ""){
				$items = $items->where("accept_source_data_type","=", request()->get("accept_source_data_type"));
			}

			if(request()->has("accept_id") && request()->get("accept_id") != ""){
				$items = $items->where("accept_id","=", request()->get("accept_id"));
			}

			if(request()->has("accept_pending") && request()->get("accept_pending") != ""){
				$items = $items->where("accept_pending","=", request()->get("accept_pending"));
			}

			if(request()->has("accept_order") && request()->get("accept_order") != ""){
				$items = $items->where("accept_order","=", request()->get("accept_order"));
			}

			if(request()->has("accept_amount_cents") && request()->get("accept_amount_cents") != ""){
				$items = $items->where("accept_amount_cents","=", request()->get("accept_amount_cents"));
			}

			if(request()->has("accept_success") && request()->get("accept_success") != ""){
				$items = $items->where("accept_success","=", request()->get("accept_success"));
			}

			if(request()->has("accept_data_message") && request()->get("accept_data_message") != ""){
				$items = $items->where("accept_data_message","=", request()->get("accept_data_message"));
			}

			if(request()->has("accept_profile_id") && request()->get("accept_profile_id") != ""){
				$items = $items->where("accept_profile_id","=", request()->get("accept_profile_id"));
			}

			if(request()->has("accept_source_data_sub_type") && request()->get("accept_source_data_sub_type") != ""){
				$items = $items->where("accept_source_data_sub_type","=", request()->get("accept_source_data_sub_type"));
			}

			if(request()->has("accept_hmac") && request()->get("accept_hmac") != ""){
				$items = $items->where("accept_hmac","=", request()->get("accept_hmac"));
			}

			if(request()->has("txn_response_code") && request()->get("txn_response_code") != ""){
				$items = $items->where("txn_response_code","=", request()->get("txn_response_code"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.payments.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.payments.edit' , $id);
     }

     public function store(AddRequestPayments $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('payments');
     }

     public function update($id , UpdateRequestPayments $request){
          $item = $this->storeOrUpdate($request, $id, true);
		return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.payments.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'payments')->with('sucess' , 'Done Delete Payments From system');
     }

     public function acceptConfirmation2(){
    
        //            Parameters
    
        $is_standalone_payment = array_key_exists("is_standalone_payment", $_GET) ? $_GET["is_standalone_payment"] : "";
        $is_capture = array_key_exists("is_capture", $_GET) ? $_GET["is_capture"] : "";
        $currency = array_key_exists("currency", $_GET) ? $_GET["currency"] : "";
        $is_3d_secure = array_key_exists("is_3d_secure", $_GET) ? $_GET["is_3d_secure"] : "";
        $source_data_type = array_key_exists("source_data_type", $_GET) ? $_GET["source_data_type"] : "";
        $acq_response_code = array_key_exists("acq_response_code", $_GET) ? $_GET["acq_response_code"] : "";
        $accept_id = array_key_exists("id", $_GET) ? $_GET["id"] : "";
        $is_auth = array_key_exists("is_auth", $_GET) ? $_GET["is_auth"] : "";
        $pending = array_key_exists("pending", $_GET) ? $_GET["pending"] : "";
        $is_void = array_key_exists("is_void", $_GET) ? $_GET["is_void"] : "";
        $getOrder = array_key_exists("order", $_GET) ? $_GET["order"] : "";
        $merchant_order_id = array_key_exists("merchant_order_id", $_GET) ? $_GET["merchant_order_id"] : ""; //payment id
        $has_parent_transaction = array_key_exists("has_parent_transaction", $_GET) ? $_GET["has_parent_transaction"] : "";
        $amount_cents = array_key_exists("amount_cents", $_GET) ? $_GET["amount_cents"] : "";
        $owner = array_key_exists("owner", $_GET) ? $_GET["owner"] : "";
        $is_refund = array_key_exists("is_refund", $_GET) ? $_GET["is_refund"] : "";
        $success = array_key_exists("success", $_GET) ? $_GET["success"] : "";
        $captured_amount = array_key_exists("captured_amount", $_GET) ? $_GET["captured_amount"] : "";
        $created_at = array_key_exists("created_at", $_GET) ? $_GET["created_at"] : "";
        $source_data_pan = array_key_exists("source_data_pan", $_GET) ? $_GET["source_data_pan"] : "";
        $error_occured = array_key_exists("error_occured", $_GET) ? $_GET["error_occured"] : "";
        $is_refunded = array_key_exists("is_refunded", $_GET) ? $_GET["is_refunded"] : "";
        $refunded_amount_cents = array_key_exists("refunded_amount_cents", $_GET) ? $_GET["refunded_amount_cents"] : "";
        $data_message = array_key_exists("data_message", $_GET) ? $_GET["data_message"] : "";
        $integration_id = array_key_exists("integration_id", $_GET) ? $_GET["integration_id"] : "";
        $source_data_sub_type = array_key_exists("source_data_sub_type", $_GET) ? $_GET["source_data_sub_type"] : "";
        $is_voided = array_key_exists("is_voided", $_GET) ? $_GET["is_voided"] : "";
        $profile_id = array_key_exists("profile_id", $_GET) ? $_GET["profile_id"] : "";
        $txn_response_code = array_key_exists("txn_response_code", $_GET) ? $_GET["txn_response_code"] : "";
        $hmac = array_key_exists("hmac", $_GET) ? $_GET["hmac"] : "";
        
    
        $order = Orders::findOrFail($merchant_order_id);

        if($order->status == Orders::STATUS_SUCCEEDED){

            alert()->error("Order had already been processed", "ERROR");
            return redirect('/');
        }
        $order_status = $order->status;
    
        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = Auth::user()->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;
    
    
        // Set the error flag to false
        $errorExists = false;
    
        if($success == 'true'){
            $payment->status = Payments::STATUS_SUCCEEDED;
        }else{
            $payment->status = Payments::STATUS_FAILED;
        }
        
        
        // Payment Data
        $payment->txn_response_code = $txn_response_code;
        $payment->accept_hmac = $hmac;
        $payment->accept_source_data_sub_type = $source_data_sub_type;
        $payment->accept_profile_id = $profile_id;
        $payment->accept_data_message = $data_message;
        $payment->accept_success = $success;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $getOrder;
        $payment->accept_pending = $pending;
        $payment->accept_id = $accept_id;
        $payment->accept_source_data_type = $source_data_type;
        
        //Save the order
        if($payment->save()){
            
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
                                enrollCourse($value->courses_id);
                            }
                        break;
    
                        case 'certificates':
                            foreach($values as $value){
                                enrollCertificate($value->courses_id, $value->certificate_id);
                            }
                        break;

                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id);
                            }
                        break;

                        default:
                    }
                }     
    
    
                // Make sure the instructors and affiliates get their transactions only once
                if ($order_status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;
    
                            $currency = ($orderPosition->currency) ? $orderPosition->currency : getCurrency();
                            if($currency == 'USD'){
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
    
    
                        }elseif($orderPosition->type == Ordersposition::TYPE_Event) {    //Event
    
    
                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;
                            
                            $currency = ($value->currency) ? $value->currency : getCurrency();
                            if($currency == 'USD'){
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
    
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
    
    
                // Link the order with the payement:
                if($success == "true"){
                    
                    $order->status =  Orders::STATUS_SUCCEEDED;
                    $order->payments_id = $payment->id;

                    $facebookConversionsApi = new FacebookConversionsAPI();
                    $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_PURCHASE, $order);
                }
                
                
                if($order->save()){
                    //Check if applied promo code and make use of it:
    
                    if($promoRow){
                        
                        connectPromoWithOrder($promoRow, $order->id);
    
                    }
                }
            }
    
        if ($success == "true") {

            // Track Post Affiliate Pro Sale

            $postAffPro = new PostAffiliateProIntegration;
            $postAffPro->trackSale($order, $promoRow);

            //Send Order Confirmation Email
            Mail::to(Auth::user()->email)->send(new OrderConfirm($order, Auth::user(), $payment->amount));
            User::addNotification([auth()->user()->id], trans('messages.notificationPurchaseTitle'), trans('messages.notificationPurchaseDescription'), '/account/myCourses');
   
        }
    
        $this->data['orderId'] = $order->id;
        $this->data['data_message'] = $data_message;
        $this->data['txn_response_code'] =  $txn_response_code;
        $this->data['txnResponseCode'] =  $success;
        $this->data['errorExists'] =  $errorExists;
    
        return view('website.confirmation', $this->data);
    
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

    public function paypalconfirmation($orderID=null){

        $order = ($orderID) ? Orders::findOrFail($orderID) : getCurrentOrder();
        if(!isset($order) || $order->status == Orders::STATUS_SUCCEEDED){

            alert()->error("Order had already been processed", "ERROR");
            return redirect('/');
        }

        if(!$order->paypalorderid){
            alert()->error("There has been an issue, please try again", "ERROR");
            return redirect('/');
        }

        $paypalOrderId = $order->paypalorderid;

        $paypalPaymentIntegration = new PaypalPaymentsIntegration;
        $result = $paypalPaymentIntegration->captureOrder($paypalOrderId);

        if(!$result || $result->status != "COMPLETED"){
            alert()->error("There has been an issue, please try again", "ERROR");
            return redirect('/cart');
        }

        $orderItems = $result->purchase_units;

        $detailedOrderItems = payPalExtractOrderItemTypes($orderItems);
        $promoCode = getCurrentPromoCode();
        if ($promoCode) {
            //Check the promo again
            $promoRow = $promoCode->promotions;
            

        }

        // if(getCurrency() == 'USD'){
        //     //get Exchange rate
        //     $exchangeRate = Payments::exchangeRate();
        //     $amount = round($exchangeRate * $detailedOrderItems['totalCost']);
        // }

        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = $detailedOrderItems['totalCost'];
        $payment->currency_id = "USD";
        $payment->user_id = Auth::user()->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $order->id;
        $payment->status = Payments::STATUS_SUCCEEDED;
        $payment->save();

        $order->payments_id = $payment->id;
        $order->status = Orders::STATUS_SUCCEEDED;
        $order->save();

        foreach($detailedOrderItems['types'] as $key => $values){
                
            switch($key){

                case 'courses': 
                    foreach($values as $value){
                        enrollCourse($value->courses_id);
                        $course = $value->courses;
                            $course_price = $value->amount;
    
                            $currency = ($value->currency) ? $value->currency : getCurrency();
                            if($currency == 'USD'){
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
    
                                $course_price = round($exchangeRate * $course_price);
                            }
                            
                            if(isset($promoRow) && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){
    
                                setInstructorAffTransactions($course, $course_price, $payment, $promoRow);
    
                            }else{
    
                                setInstructorAffTransactions($course, $course_price, $payment);
    
                            }
                    }
                break;

                case 'certificates':
                    foreach($values as $value){
                        enrollCertificate($value->courses_id, $value->certificate_id);
                    }
                break;

                case 'events':
                    foreach($values as $value){
                        enrollEvent($value->events_id);
                        $event = $value->events;
                        $event_price = $value->amount;

                        $currency = ($value->currency) ? $value->currency : getCurrency();
                        if($currency == 'USD'){
                            //get Exchange rate
                            $exchangeRate = Payments::exchangeRate();

                            $event_price = round($exchangeRate * $event_price);
                        }


                        if(isset($promoRow) && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){

                            distEventTransactions($event, $event_price, $payment, $promoRow);

                        }else{

                            distEventTransactions($event, $event_price, $payment);

                        }
                    }
                break;

                default:
            }
        }     

        // Track Post Affiliate Pro Sale

        $postAffPro = new PostAffiliateProIntegration;
        $postAffPro->trackSale($order, $promoRow);
        
        Mail::to(Auth::user()->email)->send(new OrderConfirm($order, Auth::user(), $payment->amount));
        User::addNotification([auth()->user()->id], trans('messages.notificationPurchaseTitle'), trans('messages.notificationPurchaseDescription'), '/account/myCourses');

        $this->data['orderId'] = $order->id;
        $this->data['txnResponseCode'] =  "true";
    
        return view('website.confirmation', $this->data);

        

    }

}
