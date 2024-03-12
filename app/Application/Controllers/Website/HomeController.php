<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\Controller;
use App\Application\Model\AcceptPaymentsIntegration;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Careers;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Eventsdata;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Orders;
use App\Application\Model\Partners;
use App\Application\Model\Payments;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\Talks;
use App\Application\Model\Testimonials;
use App\Application\Model\Transactions;
use App\Application\Model\Homesettings;
use App\Application\Model\Setting;
use App\Application\Model\User;
use App\Application\Model\Faq;
use App\Application\Model\FawryIntegration as ModelFawryIntegration;
use App\Application\Model\KioskIntegration as ModelKioskIntegration;
use App\Application\Model\Lecturequestions;
use App\Application\Model\MobilewalletIntegration;
use App\Application\Model\Ordersposition;
use App\Application\Model\PaymentMethods;
use App\Application\Model\PaymentsData as ModelPaymentsData;
use App\Application\Model\PostAffiliateProIntegration;
use App\Application\Model\PaypalPaymentsIntegration;
use App\Application\Model\Posts;
use App\Application\Model\Quizstudentsstatus;
use App\Mail\OrderConfirm;

use Cart;
use FawryIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use KioskIntegration;
use PaymentsData;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new = Auth::guard('api')->user();

        dd($new);

        // $homeSettings = Homesettings::where('id', 1)->first();
        // $this->data['BestSeller'] = Courses::where('published', 1)->where('type', Courses::TYPE_COURSE)->where('featured', 1)->limit(8)->orderBy('sales_count', 'desc')->get();
        // $this->data['LastCourses'] = Courses::where('published', 1)
        // ->where(function ($query) {
        //     $query->where("type", Courses::TYPE_COURSE)
        //         ->orWhere('type', Courses::TYPE_WEBINAR)
        //     ;
        // })
        // ->limit(8)->orderBy('sort', 'asc')->get();
        $this->data['featuredAll'] = Courses::where('published', 1)->where('featured', 1)->skip(0)->take(5)->orderBy('sort', 'asc')->get(); //Best Learning
        $this->data['latestReleased'] = Courses::where('published', 1)->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
        $this->data['featuredDiplomas'] = Courses::where('published', 1)->where('type', Courses::TYPE_DIPLOMAS)->inRandomOrder()->skip(0)->take(10)->get();
        $this->data['featuredCourses'] = Courses::where('published', 1)->where('type', Courses::TYPE_COURSE)->where('categories_id','!=' , 8)->where('categories_id','!=' , 9)->inRandomOrder()->skip(0)->take(10)->get();
        $this->data['featuredMasters'] = Courses::where('published', 1)->where('type', Courses::TYPE_MASTERS)->inRandomOrder()->skip(0)->take(10)->get();
        $this->data['bundleCourses'] = Courses::where('published', 1)->where('type', Courses::TYPE_BUNDLES)->inRandomOrder()->skip(0)->take(10)->get();
        $this->data['instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('hidden', 0)->skip(0)->take(10)->orderBy('sort', 'asc')->get();
        $this->data['testimonials'] = Testimonials::skip(0)->take(10)->get();

        $this->data['coursesPerCategory']['nutrition'] = Courses::where('published', 1)->where('categories_id',3)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['health'] = Courses::where('published', 1)->where('categories_id',4)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['nursing'] = Courses::where('published', 1)->where('categories_id',5)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['mentalhealth'] = Courses::where('published', 1)->where('categories_id',6)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['medical'] = Courses::where('published', 1)->where('categories_id',7)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['management'] = Courses::where('published', 1)->where('categories_id',8)->inRandomOrder()->skip(0)->take(5)->get();
        $this->data['coursesPerCategory']['childedu'] = Courses::where('published', 1)->where('categories_id',9)->inRandomOrder()->skip(0)->take(5)->get();


        $this->data['bundle_discount'] = $homeSettings->bundle_discount;
        $this->data['courses_discount'] = $homeSettings->courses_discount;
        $this->data['masters_discount'] = $homeSettings->masters_discount;
        $this->data['diplomas_discount'] = $homeSettings->diplomas_discount;

        return view('website.home', $this->data);
    }

    public function businessCourses()
    {

        $businessdata = Businessdata::findOrfail(Auth::user()->businessdata_id);
        $this->data['businessdata'] = $businessdata;

        $this->data['businessCourses'] = $businessdata->businesscourses;

        return view('website.businessCourses', $this->data);
    }
    public function welcome()
    {

        $rowId = 456; // generate a unique() row ID
        $userID = 2; // the user ID to bind the cart contents

        // add the product to cart
        Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => 'product',
            'price' => 3000,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => 'Model',
        ));
        $items = Cart::getContent();

        //        dd( getDir() );

        return view(layoutHomePage('website'));
    }



    public function deleteImage($model, $id, Request $request)
    {
        if (Auth::guard('api')->check()) {

            if (file_exists(public_path(env('UPLOAD_PATH_1') . DS . $request->name))) {
                $model = 'App\\Application\\Model\\' . ucfirst($model);
                $filed = $request->has('filed_name') ? $request->get('filed_name') : 'image';
                if (class_exists($model)) {
                    $item = $model::findorFail($id);
                    if (json_decode($item->{$filed})) {
                        $array = [];
                        foreach (json_decode($item->{$filed}) as $file) {
                            if ($file != $request->name) {
                                $array[] = $file;
                            }
                        }
                        $item->{$filed} = json_encode($array);
                        $item->save();
                        alert()->success("Done Delete", "Done");
                        return redirect()->back();
                    }elseif(isset($item->{$filed})){
                        $item->{$filed} = NULL;
                        $item->save();
                        alert()->success("Done Delete", "Done");
                        return redirect()->back();
                    }
                    alert()->error("Filed not found", "Error");
                    return redirect()->back();
                }
                alert()->error("Class not exists", "Error");
                return redirect()->back();
            }
            alert()->error("File not exists", "Error");
            return redirect()->back();
        }
        abort('404');
    }

    public function cart(Request $request)
    {


        // Start Check if order new 
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING)
                // ->orWhere('status', Orders::STATUS_VODAFONE)
                // ->orWhere('status', Orders::STATUS_KIOSK)
            ;
        })->orderBy('id', 'DESC')->first();

        $this->data['bundleDiscount'] = $bundleDiscountApplied = false;

        if(isset($order)){

//            $postAffPro = new PostAffiliateProIntegration;
//            $order->aff_id = $postAffPro->getAffiliateId($request);

            if ($order->accept_status) {
                //new Order
                $order = $this->dublicateOrderPositions($order->id);
            }

            $this->data['bundleDiscountValue'] = $bundleDiscountValue = NULL;

            $bundleDiscountSetting = Setting::where('id', 9)->get()[0];

            if(count(getShoppingCart()) > 1 && $bundleDiscountSetting->status == 1){
                $savedAmount = applyBundleDiscount(getShoppingCart());
                $bundleDiscountApplied = true;
                $this->data['bundleDiscount'] = $bundleDiscountApplied;
                $bundleDiscountValue = $bundleDiscountSetting->body_setting;
                $this->data['bundleDiscountValue'] = $bundleDiscountValue;
                $this->data['savedAmount'] = $savedAmount;
            }else{


                //Update Cart
                Promotionactive::updateOrderPositions(Auth::user()->id);

            }

           // dd($savedAmount);
        }    

        $this->data['title'] = '';

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();

        return view('website.cart', $this->data);
    }
    public function cartPayments()
    {
        return view('website.cartPayments');
    }
    public function cartFinish()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect()->back();
        }

        //User Order

        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        if ($order->accept_status) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }


        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }


       $visa = new AcceptPaymentsIntegration;
       $result = $visa->init($order, $amount_cents);

       if (!isset($result)) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        $this->data['payment_token'] = $payment_token;
        $this->data['order'] = $order;
        $this->data['amount'] = (int) getShoppingCartCost();

        $facebookConversionsApi = new FacebookConversionsAPI();
        $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT,$order);

        return view('website.cartFinish', $this->data);
    }

    public function cartFinishDirect()
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        $order = createDirectPayOrder($course);

        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;

        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }

        $visa = new AcceptPaymentsIntegration;
        $result = $visa->init($order, $amount_cents);
        
         if (!isset($result)) {
             alert()->info(trans('website.Wrong'), trans('website.Error Message'));
             return redirect()->back();
         }


        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        return response()->json(['success'=>true , 'type'=>'direct' , 'token'=>$payment_token ,'order'=>$order], 200);

    
    }

    static function dublicateOrderPositions($Order_id)
    {
        $oldOrder = Orders::where('user_id', Auth::user()->id)->where('id', $Order_id)->with('ordersposition')->orderBy('id', 'DESC')->first();
        $oldOrder->load('ordersposition');

        $newOrder = $oldOrder->replicate();
        $newOrder->accept_status = 0;
        $newOrder->accept_order_id = null;
        $newOrder->save();



        foreach ($oldOrder->ordersposition as $option) {
            $new_option = $option->replicate();
            $new_option->orders_id = $newOrder->id;
            $new_option->push();
        }
        // dd($newOrder);
        $oldOrder->status = Orders::STATUS_FAILED;
        $oldOrder->save();


        return $newOrder;
    }

    public function cartFinishVodafone()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }


        ///////////// Variables \\\\\\\\\\\\\\
        $this->data['amount'] = getShoppingCartCost();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }

        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
            
        })->orderBy('id', 'DESC')->first();
        
        $order->status = Orders::STATUS_VODAFONE;
        $order->save();

                
        //Clear PromoCode
        Promotionactive::removeActivePromo();

        $this->data['order'] = $order;
        
        return view('website.cartFinishVodafone', $this->data);
    }

    public function cartFinishVodafoneDirect()
    {

        $course_id = $_GET['id'];

        $course = Courses::findOrfail($course_id);

        //Create new order
      
        $order = createDirectPayOrder($course);

        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;

        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }
       
        $order->status = Orders::STATUS_VODAFONE;
        $order->save();

        $this->data['order'] = $order;
    
        return response()->json(['success'=>true , 'type'=>'direct' , 'order'=>$order], 200);
       
    }


    public function cartFinishKiosk($type = 'masary')
    {
        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }

        $this->data['amount'] = (int) getShoppingCartCost();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }

        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        $kiosk = new ModelKioskIntegration;
        $result = $kiosk->init($order, $amount_cents, ModelKioskIntegration::KIOSK_PAYMENT_TYPE, ModelKioskIntegration::KIOSK_PAYMENT_TYPE);

        if(!isset($result['data']['bill_reference'])){
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        $payment_data = $result['data']['bill_reference'];
        $order->kiosk_id = $payment_data;
        $order->status =  Orders::STATUS_KIOSK;
        $order->save();

        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;
        
        $this->data['type'] = $type;
        return view('website.cartFinishKiosk', $this->data);
    }


    public function cartFinishKioskDirect($type = 'masary')
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        //Check the existing of pending order for this user
      
        $order = createDirectPayOrder($course);


        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }


        $kiosk = new ModelKioskIntegration;

        $result = $kiosk->init($order, $amount_cents, ModelKioskIntegration::KIOSK_PAYMENT_TYPE, ModelKioskIntegration::KIOSK_PAYMENT_TYPE);

        if(!isset($result['data']['bill_reference'])){
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        $payment_data = $result['data']['bill_reference'];
        $order->kiosk_id = $payment_data;
        $order->status =  Orders::STATUS_KIOSK;
        $order->save();

        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;
        $this->data['type'] = $type;

        return response()->json(['success'=>true , 'type'=>'direct' , 'payment_data'=>$payment_data ,'order'=>$order], 200);
    }

    public function cartFinishFawry()
    {
        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }
        $this->data['amount'] = (int) getShoppingCartCost();
        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        $currency = getCurrency();

        $amount_cents = ceil(getShoppingCartCost()) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }

        $fawry = new ModelFawryIntegration;
        $payment_data = $fawry->init($order, $amount_cents);

        $order->status =  Orders::STATUS_FAWRY;
        $order->save();


        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;
        

        return view('website.fawry', $this->data);
    }

    public function cartFinishFawryDirect()
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        $order = createDirectPayOrder($course);

        $currency = getCurrency();

        $amount_cents = ceil($course->OriginalPrice) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }

        $fawry = new ModelFawryIntegration;
        $payment_data = $fawry->init($order, $amount_cents);

        $order->status =  Orders::STATUS_FAWRY;
        $order->save();


        return response()->json(['success'=>true , 'type'=>'direct' , 'payment_data'=>$payment_data ,'order'=>$order], 200);
    }

    public function cartFinishMobileWallet()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }
        $this->data['amount'] = (int) getShoppingCartCost();
        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }


        if (!empty($_POST['mobile'])) {

            $mobile = $_POST['mobile'];

            $wallet = new MobilewalletIntegration;
            $result = $wallet->init($order, $amount_cents, MobilewalletIntegration::KIOSK_PAYMENT_TYPE, $mobile);

            if (isset($result['redirect_url'])) {
                return redirect($result['redirect_url']);
            } else {
                if (isset($result['error'])) {
                    alert()->info(trans('website.Wrong'), $result['error']);
                } else {
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                }
            }


            $order->status =  Orders::STATUS_MOBILEWALLET;
            $order->save();
        }

        $this->data['order'] = $order;
        

        return view('website.mobilewallet', $this->data);
    }

    public function cartFinishMobileWalletDirect()
    {
        if (!empty($_GET['mobile'])) {

            $mobile = $_GET['mobile'];
            $course_id = $_GET['course_id'];

            //Create new order

            $course = Courses::findOrfail($course_id);

            $order = createDirectPayOrder($course);

            $currency = getCurrency();
            $amount_cents = ceil($course->OriginalPrice) * 100;
            if ($currency == 'USD') {
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
            }

            $wallet = new MobilewalletIntegration;
            $result = $wallet->init($order, $amount_cents, MobilewalletIntegration::KIOSK_PAYMENT_TYPE, $mobile);

            if (isset($result['redirect_url']) AND !empty($result['redirect_url'])) {

                return response()->json(['success'=>true ,'redirect_url'=>$result['redirect_url'], 'type'=>'direct' ,'order'=>$order], 200);

            }elseif (isset($result['iframe_redirection_url'])) {

                return response()->json(['success'=>true ,'redirect_url'=>$result['iframe_redirection_url'], 'type'=>'direct' ,'order'=>$order], 200);

            } else {
                if (isset($result['error'])) {
                    return response()->json(['success'=>false , 'type'=>'direct'], 200);
                } else {
                    return response()->json(['success'=>false , 'type'=>'direct'], 200);
                }
            }

            $order->status =  Orders::STATUS_MOBILEWALLET;
            $order->save();

            return response()->json(['success'=>true , 'type'=>'direct' ,'order'=>$order], 200);

        }
        

        return response()->json(['success'=>true , 'type'=>'direct' ], 200);
    }


    public function insertCoupon(Request $request)
    {

        $bundleDiscountSetting = Setting::where('id', 9)->get()[0];


        if($bundleDiscountSetting->status == 1 && count(getShoppingCart()) > 1){

            alert()->error(trans('defualt.Problem adding the coupon'), trans('website.bundle discount applied'));
            return redirect()->back();

        }else{

            //Save data:
            if (isset($_POST['code'])) {

                // submitted values
                $code = $_POST['code'];
                $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
                $promoRow = Promotions::where('code', $code)->first();
                
                if ($promoRow && Promotions::isValid($promoRow, $course_id)) {

                    $Promotionactive = Promotionactive::setActivePromo($promoRow->id);
                    alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                    if($course_id){
                        $coursesController = new CoursesController(Courses::findOrFail($course_id));
                        $coursesController->addToCart($course_id, $request);
                    }
                
                } else {

                    alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));

                }
            }

        }

        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);
        return redirect()->back();
    }

    public function insertCouponAjax()
    {

        //Save data:
        if (isset($_GET['promoCode'])) {
            $course = Courses::findOrfail($_GET['course_id']) ;
            // submitted values
            $code = $_GET['promoCode'];
            $promoRow = Promotions::where('code', $code)->first();

            if ($promoRow && Promotions::isValid($promoRow, $course->id)) {
                
                $Promotionactive = Promotionactive::setActivePromo($promoRow->id);
                return response()->json(['success'=>true ,'originalPrice'=>$course->originalPrice,'title'=>trans('website.Success'),'text'=>trans('defualt.Coupon added successfully'),'promo'=>$code, 'type'=>'success'], 200);

            } else {
                // alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                return response()->json(['success'=>false ,'title'=>trans('website.Error Message'),'text'=>trans('defualt.Problem adding the coupon'), 'type'=>'error'], 200);
            }
        }

        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);

        return response()->json(['success'=>true , 'type'=>'direct'], 200);
        
    }

    public function removePromoAjax()
    {
        $course = Courses::findOrfail($_GET['course_id']) ;
        Promotionactive::where('user_id', Auth::user()->id)->where('status', 1)->update(array('status' => 0));
        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);
        return response()->json(['success'=>false ,'title'=>trans('website.Error Message'),'text'=>trans('defualt.Coupon was deleted successfully'),'originalPrice'=>$course->originalPrice, 'type'=>'success'], 200);
    }


    public function removePromo()
    {
        Promotionactive::where('user_id', Auth::user()->id)->where('status', 1)->update(array('status' => 0));
        alert()->warning(trans('defualt.Coupon was deleted successfully'), trans('website.Error Message'));

        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);
        return redirect()->back();
    }

    public function actionHasWallet($id)
    {


        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where('id', $id)->orderBy('id', 'DESC')->first();
        $order->status = Orders::STATUS_PENDING;
        $order->save();

        return redirect('/site/cartFinishMobileWallet');
    }


    public function directPay(Request $request){


        $this->data['payment_token'] = null;

        if($request->has('currency') && $request->has('amount')){
            
            $currency = $request->all()['currency'];
            $amount = $request->all()['amount'];
            $visa = new AcceptPaymentsIntegration;
  
            $orderPosition = newDirectPayOrder($amount, $currency);
            $this->data['orderPosition'] = $orderPosition;

            $amount_cents = ceil($amount) * 100;

            if ($currency == 'USD') {
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                
                $amount_cents = round($exchangeRate * $amount_cents);
            }
            

            $result = $visa->init($orderPosition->orders, $amount_cents);

            if (!isset($result)) {
                alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                return redirect()->back();
            }
    
            
    
            $this->data['payment_token'] = $result;
        }

        return view('website.directpay', $this->data);
    }

    public function directPay2($orderID, Request $request){

        
        $order = Orders::findOrFail($orderID);
        $errorMessage = null;
        if(Auth::check() && $order->user_id != Auth::user()->id){
            return redirect('/');
        }

        if($order->status == Orders::STATUS_SUCCEEDED){
            $errorMessage = trans('orders.This order had already been paid');
        }

        if(!Auth::check()){
            $errorMessage = trans('orders.You must sign-in in order to view this page');
        }

        $this->data['error'] = $errorMessage;

        $this->data['order'] = $order;

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();


        $this->data['payment_token'] = null;

        if($request->has('currency') && $request->has('amount')){
            
            $currency = $request->all()['currency'];
            $amount = $request->all()['amount'];
            $visa = new AcceptPaymentsIntegration;
            
            $orderPosition = newDirectPayOrder($amount, $currency);
            $this->data['orderPosition'] = $orderPosition;

            $amount_cents = ceil($amount) * 100;

            if ($currency == 'USD') {
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
            }

            $result = $visa->init($orderPosition->orders, $amount_cents);

            if (!isset($result)) {
                alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                return redirect()->back();
            }
    
            
    
            $this->data['payment_token'] = $result;
        }

        return view('website.directpay2', $this->data);
    }

    public function instructor($slug)
    {
        $this->data['instructor'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('slug', $slug)->firstOrFail();
        $this->data['latestTenCourses'] = Courses::where('instructor_id', $this->data['instructor']['id'])->where('soon', 0)->where('published', 1)->where('type', '!=', Courses::TYPE_WEBINAR)->get()->all();
        $this->data['latestTenTalks'] = Talks::where('instructor_id', $this->data['instructor']['id'])->get()->all();
        return view('website.instructor', $this->data);
    }

    public function partner($slug)
    {


        $this->data['partner'] = User::where('group_id', User::TYPE_INSTITUTION)->where('slug', $slug)->firstOrFail();
        $eventsDataId = Eventsdata::where('user_id', $this->data['partner']->id)->firstOrFail()->id;
        $this->data['latestTenCourses'] = Courses::where('instructor_id', $this->data['partner']['id'])->get();
        $this->data['latestTenTalks'] = Talks::where('instructor_id', $this->data['partner']['id'])->get();
        $this->data['latestTenEvents'] = Events::where('eventsdata_id', $eventsDataId)->get();
        return view('website.instructor', $this->data);
    }

    public function AllInstructors()
    {
        $this->data['Instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('activated', 1)->where('verified', 1)->where('hidden', 0)->paginate(15);
        return view('website.instructors', $this->data);
    }

    public function AllPartners()
    {
        $this->data['Partners'] = User::where('group_id', User::TYPE_INSTITUTION)->where('activated', 1)->where('verified', 1)->where('hidden', 0)->paginate(8);
        return view('website.instructors', $this->data);
    }

    public function joinAsInstructor()
    {
        $this->data['Instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('activated', 1)->where('verified', 1)->paginate(8);
        return view('website.joinAsInstructor', $this->data);
    }
    public function thankyou()
    {
        $this->data['title'] = trans('partnership.Institution');
        return view('website.partnership.thankyou', $this->data);
    }
    public function landing()
    {
        return view('website.partnership.landing');
    }
    public function business()
    {
        $this->data['title'] = '545';
        return view('website.business.index', $this->data);
    }


    public function testNotifi()
    {
        // return User::getById();
        //  return User::addNotification([auth()->user()->id], 'You have a new question lecture ', 'You have a new question lecture ', '/courses/courseLecture/id/');
        // return User::readNotification(auth()->user()->id, "-MQ5IcQ-HemYPXuAHYBF");

    }
    public  function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //check if exist code
        $code = Eventstickets::where('code', $randomString)->first();
        if ($code) {
            $this->generateRandomString($length);
        }

        return $randomString;
    }
    public function faq()
    {
        $this->data['title'] = trans('faq.faq');
        $this->data['faq'] = Faq::groupBy('group_id')->get();


        return view('website.faq', $this->data);
    }
    public function ourteam()
    {
        $this->data['title'] = trans('page.ourteam');

        return view('website.ourteam', $this->data);
    }

    public function verifyCertificate(Request $request) {


        $this->data['certificate'] = null;

        if(isset($request->request->all()['certificate_id'])){

            $this->data['certificate'] = Quizstudentsstatus::where('id', $request->all()['certificate_id'])->where('passed', 1)->whereNotNull('certificate')->first();
        }

        return view('website.verifyCertificate', $this->data);

    }


    public function posts($category=null, $slug=null){

        $post = Posts::where('slug', $slug)->first();

        if($category && $slug && $post){

            return redirect("http://igtsservice.com/blog/".$category.'/'. $slug);

        }elseif($category && !$slug && $post){

            return redirect("http://igtsservice.com/blog/".$category);

        }else{

            return abort(404);

        }

    }

    public function payments(){

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();

        return view('website.payments', $this->data);

    }

    public function paypal($orderID=null){

        $paypalPaymentIntegration = new PaypalPaymentsIntegration;
        $result = ($orderID) ? $paypalPaymentIntegration->init($orderID) : $paypalPaymentIntegration->init();
        
        if(!$result){
            alert()->error("There has been an issue, please try again", "ERROR");
            return redirect('/cart');
        }

        $order = getCurrentOrder();
        if($orderID){
            $order = Orders::findOrFail($orderID);
        }
        $order->paypalorderid = $result['id'];
        $order->save();
        
        return redirect($result['links'][1]['href']);

    }

    public function ajaxPayVisa($orderID=null){


        if (!$orderID && count(getShoppingCart()) < 1) {
            return response()->json(['success'=>false , 'type'=>'visa'], 400);
        }

        //User Order

        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        if($orderID){
            $order = Orders::findOrFail($orderID);
        }

        if ($order->accept_status) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }


        if($orderID){
            $currency = ($order->payments->currency_id == 34) ? 'EGP' : 'USD';
            $amount_cents = $order->payments->amount * 100;
        }else{
            $currency = getCurrency();
            $amount_cents = ceil(getShoppingCartCost()) * 100;
        }

        if ($currency == 'USD') {
            //get Exchange rate
            $exchangeRate = Payments::exchangeRate();
            $amount_cents = round($exchangeRate * $amount_cents);
        }


       $visa = new AcceptPaymentsIntegration;
       $result = $visa->init($order, $amount_cents);

       if (!isset($result)) {
            // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false , 'type'=>'visa'], 400);

        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        return response()->json(['success'=>true , 'type'=>'visa' , 'token'=>$payment_token ,'order'=>$order], 200);

    }

    public function test(){

        $test = new PostAffiliateProIntegration;

    }


    public function checkoutApi(Request $request){

        $user = Auth::guard('api')->user();
        Auth::guard()->login($user);
//        dd($user);
        return response(apiReturn(['url'=>'https://igtsservice.com/cart'], '', ''), 200);

//        return redirect('site/payments');
    }
}
