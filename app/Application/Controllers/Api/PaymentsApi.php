<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\Orders;
use App\Application\Model\Ordersposition;
use App\Application\Model\Payments;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\Transactions;
use App\Application\Model\User;
use App\Application\Transformers\PaymentsTransformers;
use App\Application\Requests\Website\Payments\ApiAddRequestPayments;
use App\Application\Requests\Website\Payments\ApiUpdateRequestPayments;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class PaymentsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Payments $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPayments $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPayments $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PaymentsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PaymentsTransformers::transform($data) + $paginate), $status_code);
    }


    public function actionAcceptConfirmationCallback2(Request $request)
    {
        //            Parameters


        $myArray =   $request;

        $object =  (array) $myArray["obj"];
        $data =  (array) $object["data"];
        $source_data =  (array) $object["source_data"];
        $order =  (array) $object["order"];

        $currency =  ($order['currency']) ? $order['currency'] : "";
        $source_data_type =  ($source_data['type']) ? $source_data['type'] : "";
        $accept_id =  ($object['id']) ? $object['id'] : "";
        $pending = ($object['pending']) ? $object['pending'] : "";
        $getOrder = ($order['id']) ? $order['id'] : "";
        $merchant_order_id = ($order['merchant_order_id']) ? $order['merchant_order_id'] : "";
        $amount_cents = ($order['amount_cents']) ? $order['amount_cents'] : "";
        $success = ($object['success']) ? $object['success'] : "";
        $data_message = ($data['message']) ? $data['message'] : "";
        $source_data_sub_type = ($source_data['sub_type']) ? $source_data['sub_type'] : "";
        $profile_id =  ($object['profile_id']) ? $object['profile_id'] : "";
        $txn_response_code = ($data['txn_response_code']) ? $data['txn_response_code'] : "";
        $hmac = (isset($data['hmac'])) ? $data['hmac'] : "";  // not found


        $order = Orders::findOrFail($merchant_order_id);
        $order_status = $order->status;

        $user = User::findOrFail($order->user_id);


        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = $user->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;


        // Set the error flag to false
        $errorExists = false;

        if ($success == 'true') {
            $payment->status = Payments::STATUS_SUCCEEDED;
        } else {
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

            if($order && $payment->status == Payments::STATUS_SUCCEEDED){

                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
     
                $promoCode = getCurrentPromoCode($user->id);
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;


                }
                
                foreach($itemsArr as $key => $values){
                   
                    switch($key){

                        case 'courses': 
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id);
                            }
                        break;


                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
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


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event){    //Event


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


                // Link the order with the payement:
                if($success == "true"){
                    $order->status =  Orders::STATUS_SUCCEEDED;
                    $order->payments_id = $payment->id;
                }
                
                if($order->save()){
                    //Check if applied promo code and make use of it:

                    if($promoRow){
                        
                        connectPromoWithOrder($promoRow, $order->id, $user->id);

                    }
                }
            }

        if ($success == "true") {
            //Send Order Confirmation Email

        }


            // $this->data['test'] = $test;
            $this->data['orderId'] = $order->id;
            $this->data['data_message'] = $data_message;
            $this->data['txn_response_code'] =  $txn_response_code;
            $this->data['txnResponseCode'] =  $success;
            $this->data['errorExists'] =  $errorExists;

            var_dump($this->data);
    }

    public function actionFawryConfirmationCallback(Request $request) {
        //            Parameters

        $myArray =   $request;   
      
        $orderItems =  (array) $myArray["orderItems"];

        $requestId =  ($myArray['requestId']) ? $myArray['requestId'] : "";
        $fawryRefNumber =  ($myArray['fawryRefNumber']) ? $myArray['fawryRefNumber'] : "";
        $merchantRefNumber =  ($myArray['merchantRefNumber']) ? $myArray['merchantRefNumber'] : "";
        $customerMobile =  ($myArray['customerMobile']) ? $myArray['customerMobile'] : "";
        $customerMail =  ($myArray['customerMail']) ? $myArray['customerMail'] : "";
        $paymentAmount =  ($myArray['paymentAmount']) ? $myArray['paymentAmount'] : "";
        $amount_cents =  ($myArray['orderAmount']) ? $myArray['orderAmount'] : "";
        $fawryFees =  ($myArray['fawryFees']) ? $myArray['fawryFees'] : "";
        $shippingFees =  ($myArray['shippingFees']) ? $myArray['shippingFees'] : "";
        $orderStatus =  ($myArray['orderStatus']) ? $myArray['orderStatus'] : "";
        $paymentMethod =  ($myArray['paymentMethod']) ? $myArray['paymentMethod'] : "";
        $messageSignature =  ($myArray['messageSignature']) ? $myArray['messageSignature'] : "";
        $orderExpiryDate =  ($myArray['orderExpiryDate']) ? $myArray['orderExpiryDate'] : "";
        $merchant_order_id =  ($myArray['merchantRefNumber']) ? $myArray['merchantRefNumber'] : "";
        $price =  ($myArray['orderAmount']) ? $myArray['orderAmount'] : "";
        $quantity =  ($orderItems[0]['quantity']) ? $orderItems[0]['quantity'] : "";
        $failureReason =  ($myArray['failureReason']) ? $myArray['failureReason'] : "";
        $failureErrorCode =  ($myArray['failureErrorCode']) ? $myArray['failureErrorCode'] : "";
        $paymentTime =  ($myArray['paymentTime']) ? $myArray['paymentTime'] : "";


        // $is_capture = array_key_exists("is_capture", $_GET) ? $_GET["is_capture"] : "";
        $order = Orders::findOrFail($merchant_order_id);
        $order_status = $order->status;

        $user = User::findOrFail($order->user_id);
        $currency = 'EGP';
        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = $user->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;

        // Set the error flag to false
        $errorExists = false;


        if($orderStatus == 'PAID'){
            $payment->status = Payments::STATUS_SUCCEEDED;
        }else{
            $payment->status = $orderStatus;
        }

        $payment->txn_response_code = $failureReason;
        $payment->accept_hmac = $requestId;
        $payment->accept_source_data_sub_type = $paymentMethod;
        $payment->accept_profile_id = $fawryFees;
        $payment->accept_data_message = $messageSignature;
        $payment->accept_success = $orderStatus;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $failureErrorCode;
        $payment->accept_pending = $orderExpiryDate;
        $payment->accept_source_data_type = $paymentMethod;

        //Save the order
        if($payment->save()){
    
            $promoRow = null;

            if($order && $payment->status == Payments::STATUS_SUCCEEDED){

                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
                $promoCode = getCurrentPromoCode();
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;
                    
                }
                
                foreach($itemsArr as $key => $values){
          
                    switch($key){

                        case 'courses': 
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id);
                            }
                        break;


                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
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


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event) {    //Event


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


                // Link the order with the payement:
                    if($orderStatus == "PAID"){
                        $order->status =  Orders::STATUS_SUCCEEDED;
                        $order->payments_id = $payment->id;
                    }
                
                if($order->save()){
                    //Check if applied promo code and make use of it:

                    if($promoRow){
                        
                        connectPromoWithOrder($promoRow, $order->id, $user->id);

                    }
                }
            }

        if($orderStatus == "PAID"){

            //send order confirmation email


            $result[] = array(
                'status' => 200,
                'result' =>'DONE',
            );

        }else{
            $result[] = array(
                'status' => 400,
                'result' =>'ERROR',
            );
        }

        var_dump($result);

    }

}
