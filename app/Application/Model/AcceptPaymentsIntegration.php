<?php
namespace App\Application\Model;

use App\Application\Model\Payments;
use Illuminate\Support\Facades\Auth;

class AcceptPaymentsIntegration extends PaymentIntegrations{


    const URL_ACCEPT_EGYPT  = 'https://accept.paymobsolutions.com';
    const URL_ACCEPT_UAE  = 'https://uae.paymob.com';

    const ACCEPT_AUTH_URL = self::URL_ACCEPT_UAE . "/api/auth/tokens";
    const ACCEPT_ORDER_URL = self::URL_ACCEPT_UAE ."/api/ecommerce/orders";
    const ACCEPT_PAYMENT_KEY_URL = self::URL_ACCEPT_UAE ."/api/acceptance/payment_keys";
    const ACCEPT_PAY_URL = self::URL_ACCEPT_UAE ."/api/acceptance/payments/pay";

    const ACCEPT_INTEGRATION_ID = 14469;
    //   card integration_id test = 14012  live = 14469 will be provided upon signing up, test  UAE_Test = 14012
    const ACCEPT_INTEGRATION_ID_APPLE = '65861';
    const ACCEPT_INTEGRATION_ID_GOOGLE = '65860';


    const SECRET_KEY = "are_sk_live_364fd9cd04d9c38823f8ffd4dd6018e56179013d05bf6e085d00d19854fe940b";
    //live = are_sk_live_364fd9cd04d9c38823f8ffd4dd6018e56179013d05bf6e085d00d19854fe940b  test = are_sk_test_124a8359b6f8e4e643f2b0803c94e22815437662a10365d8d91c94b265d6e204

    const ACCEPT_Public_key = 'are_pk_live_cg4lEUsvX3vbpJfCalnHJIGYs796IKwq';
    //live = are_pk_live_cg4lEUsvX3vbpJfCalnHJIGYs796IKwq  test =are_pk_test_LnlrFPQo2GnXRxd3zsIglqHsbARGdYfM

    const ACCEPT_INTEGRATION_ID_KOISK = '19022';   //test = 19022 , live = 15360 , live = 14927
    const ACCEPT_INTEGRATION_ID_MOBILEWALLET = '129400'; //test = 129400 , live = 132169
    //UAE //const ACCEPT_API_KEY = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0luQnliMlpwYkdWZmNHc2lPak0zTnpFc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaWZRLmZ4ZmZwSmpmbGJTd1FKQXhwT216aHpUcVhrV3ZxNFlINnpkUDFfRmxISlZQLTJiR2ZVX3UtUGJDaWhxQUlPU2RBREhtQTJXZDBqNEJyYjRIaVBfQmV3';
    const ACCEPT_API_KEY = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRBek1qSXNJbTVoYldVaU9pSnBibWwwYVdGc0luMC5WUlVESkdVSEsxQW9TX0VqeUhLMDgteFA4V3g3cWd5bDI1d3RLdUtFbmR4ekFLcGE3RGJWSjZHSGxmX2NHWmpzTlgtOW1Talh4Z1dJdk5RVVBtUnI4Zw==';


    protected function callAPI($postdata, $URL, $token=null)
    {

        $curl = curl_init();

        if($token){

            curl_setopt_array($curl, array(
                CURLOPT_URL => $URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$token",
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

        }else{

            curl_setopt_array($curl, array(
                CURLOPT_URL => $URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

        }

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result ;

    }

    function acceptAuthentication()
    {

        $data = array(
            "api_key" => AcceptPaymentsIntegration::ACCEPT_API_KEY,
        );
        $postdata = json_encode($data);

        $acceptAuthentication = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_AUTH_URL);


        if (!isset($acceptAuthentication['token'])) {
            return null;
        }
        return $acceptAuthentication['token'];

    }

    function acceptOrderCreation($token, $order, $amount_cents)
    {

        $data = array(
            "auth_token" => $token,
            "delivery_needed" => "false",
            "merchant_id" => "10322",
            "merchant_order_id" => $order->id,
            "amount_cents" => $amount_cents,
            "currency" => "AED",   //Egypt EGP - Emirates AED
            "items" => [],
        );
        $postdata = json_encode($data);

        $acceptOrderCreation = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_ORDER_URL, $token);

        if(isset($acceptOrderCreation['message']) &&  $acceptOrderCreation['message'] == "duplicate"){


            $oldOrder = Orders::where('user_id', Auth::guard('api')->user()->id)->where('id', $order->id)->with('ordersposition')->orderBy('id', 'DESC')->first();
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

            return $this->acceptOrderCreation($token, $newOrder, $amount_cents);

        }

        if (!isset($acceptOrderCreation['id'])) {
            return null;
        }

        // save accept_order_id in order
        $order->accept_order_id = $acceptOrderCreation['id'];
        $order->save();

        return $order->accept_order_id;

    }


    function acceptPaymentKeyGeneration($token, $amount_cents, $acceptOrderId){

        $data = array(
            "auth_token" => $token, // auth token obtained from step1
            "amount_cents" => $amount_cents,
            "expiration" => 3600,
            "order_id" => $acceptOrderId, // id obtained in step 2
            "currency" => "AED",
            "integration_id" => AcceptPaymentsIntegration::ACCEPT_INTEGRATION_ID, // card integration_id test = 13972  live = 15187 will be provided upon signing up, test
            "lock_order_when_paid" => "false", // optional field (*)
            "billing_data" => array(
                "apartment" => "NA",
                "email" => (Auth::guard('api')->user()->email) ? Auth::guard('api')->user()->email : 'NA',
                "floor" => "NA",
                "first_name" => (Auth::guard('api')->user()->name) ? Auth::guard('api')->user()->name : 'NA',
                "street" => "NA",
                "building" => "NA",
                "phone_number" => (Auth::guard('api')->user()->mobile) ? Auth::guard('api')->user()->mobile : 'NA',
                "shipping_method" => "PKG",
                "postal_code" => "NA",
                "city" => "NA",
                "country" => "NA",
                "last_name" => (Auth::guard('api')->user()->name) ? Auth::guard('api')->user()->name : 'NA',
                "state" => "NA",
            ),
        );
        $postdata = json_encode($data);

        $acceptPaymentKeyGeneration = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_PAYMENT_KEY_URL);

        if (!isset($acceptPaymentKeyGeneration['token'])) {
            return null;
        }
        return $acceptPaymentKeyGeneration['token'];
    }

    function acceptPayRequest($payment_token, $paymentType, $identifier){

        $data = array(

            "payment_token" => $payment_token, // token obtained in step 3
            "source" => array(
                "identifier" => $identifier,
                "subtype" => $paymentType
            ),
        );
        $postdata = json_encode($data);

        $result = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_PAY_URL);

        return $result;

    }

    public function init($order, $amount_cents, $paymentType=null, $identifier=null)
    {
        //STEP 1 - Accept Authentication
        $token = $this->acceptAuthentication();

        if (!$token) {
            return null;
        }
        if ($order->accept_order_id) {
            $acceptOrderId = $order->accept_order_id;
        }else{
            //STEP 2 - Accept Order Creation
            $acceptOrderId = $this->acceptOrderCreation($token, $order, $amount_cents);
            if(!$acceptOrderId){
                return null;
            }
        }
        //STEP 3 - Accept Payment Key Generation
        $result = $this->acceptPaymentKeyGeneration($token, $amount_cents, $acceptOrderId);
        if(!$result){
            return null;
        }
        // Go to step 4 if payment is not visa/mastercard
        if(($paymentType)){

            //STEP 4 - Accept Pay Request
            $result = $this->acceptPayRequest($result, $paymentType, $identifier);
        }
        return $result;
    }

    public function intention($order, $amount_cents, $paymentType=null, $identifier=null)
    {
        $data = array(
            "amount" => $amount_cents ,
            "currency" => "AED",
            "payment_methods" => [self::ACCEPT_INTEGRATION_ID,self::ACCEPT_INTEGRATION_ID_APPLE,self::ACCEPT_INTEGRATION_ID_GOOGLE],
            "billing_data" => array(
                "apartment" => "NA",
                "first_name" => (Auth::guard('api')->user()->name) ? Auth::guard('api')->user()->name : 'NA',
                "last_name" => (Auth::guard('api')->user()->name) ? Auth::guard('api')->user()->name : 'NA',
                "street" => "NA",
                "building" => "NA",
                "phone_number" => (Auth::guard('api')->user()->mobile) ? Auth::guard('api')->user()->mobile : 'NA',
                "city" => "NA",
                "country" => "NA",
                "email" => (Auth::guard('api')->user()->email) ? Auth::guard('api')->user()->email : 'NA',
                "floor" => "NA",
                "state" => "NA"
            ),
            "items" => array(
                array(
                    "name" => "Course",
                    "amount" => $amount_cents ,
                    "description" => "description",
                    "quantity" => 1
                )
            ),
            "extras" => array(
                "order_id" => $order->id // id obtained in step 2
            ),


            "special_reference" => $order->id,
            "notification_url" => 'https://igtsservice.com/api/site/applepay/acceptConfirmationCallback',
            "redirection_url" => 'https://igtsservice.com/api/site/applepay/acceptConfirmationCallback' // id obtained in step 2

        );
        $postdata = json_encode($data);


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://uae.paymob.com/v1/intention/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postdata,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Token ". self::SECRET_KEY,
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);

        return $result['client_secret'] ;

    }

}