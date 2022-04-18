<?php
namespace App\Application\Model;

use App\Application\Model\Payments;
use Illuminate\Support\Facades\Auth;

class AcceptPaymentsIntegration extends PaymentIntegrations{

    const ACCEPT_AUTH_URL = "https://accept.paymobsolutions.com/api/auth/tokens";
    const ACCEPT_ORDER_URL = "https://accept.paymobsolutions.com/api/ecommerce/orders";
    const ACCEPT_PAYMENT_KEY_URL = "https://accept.paymobsolutions.com/api/acceptance/payment_keys";
    const ACCEPT_PAY_URL = "https://accept.paymobsolutions.com/api/acceptance/payments/pay";
    
    const ACCEPT_INTEGRATION_ID = '5976';  //   card integration_id test = 5976  live = 15187 will be provided upon signing up, test
    const ACCEPT_INTEGRATION_ID_KOISK = '19022';   //test = 19022 , live = 15360 , live = 14927
    const ACCEPT_INTEGRATION_ID_MOBILEWALLET = '132169'; //test = 129400 , live = 132169
    const ACCEPT_API_KEY = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0luQnliMlpwYkdWZmNHc2lPak0zTnpFc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaWZRLmZ4ZmZwSmpmbGJTd1FKQXhwT216aHpUcVhrV3ZxNFlINnpkUDFfRmxISlZQLTJiR2ZVX3UtUGJDaWhxQUlPU2RBREhtQTJXZDBqNEJyYjRIaVBfQmV3';


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
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }
        return $acceptAuthentication['token'];

    }

    function acceptOrderCreation($token, $order, $amount_cents)
    {

        $data = array(
            "auth_token" => $token,
            "delivery_needed" => "false",
            "merchant_id" => "3771",
            "merchant_order_id" => $order->id,
            "amount_cents" => $amount_cents,
            "currency" => "EGP",
            "items" => [],
        );
        $postdata = json_encode($data);

        $acceptOrderCreation = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_ORDER_URL, $token);
        if(isset($acceptOrderCreation['message']) &&  $acceptOrderCreation['message'] == "duplicate"){

           
                $oldOrder = Orders::where('user_id', Auth::user()->id)->where('id', $order->id)->with('ordersposition')->orderBy('id', 'DESC')->first();
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

                $this->acceptOrderCreation($token, $newOrder, $amount_cents);
            
        }

        if (!isset($acceptOrderCreation['id'])) {

            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            //return redirect('/cart');
            return;
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
            "currency" => "EGP",
            "integration_id" => AcceptPaymentsIntegration::ACCEPT_INTEGRATION_ID, // card integration_id test = 13972  live = 15187 will be provided upon signing up, test
            "lock_order_when_paid" => "false", // optional field (*)
            "billing_data" => array(
                "apartment" => "NA",
                "email" => (Auth::user()->email) ? Auth::user()->email : 'NA',
                "floor" => "NA",
                "first_name" => (Auth::user()->name) ? Auth::user()->name : 'NA',
                "street" => "NA",
                "building" => "NA",
                "phone_number" => (Auth::user()->mobile) ? Auth::user()->mobile : 'NA',
                "shipping_method" => "PKG",
                "postal_code" => "NA",
                "city" => "NA",
                "country" => "NA",
                "last_name" => " NA",
                "state" => "NA",
            ),
        );
        $postdata = json_encode($data);

        $acceptPaymentKeyGeneration = $this->callAPI($postdata, AcceptPaymentsIntegration::ACCEPT_PAYMENT_KEY_URL);
        
        if (!isset($acceptPaymentKeyGeneration['token'])) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
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

        if($order->kiosk_id){

            $payment_data = $order->kiosk_id;

        }else{

            if ($order->accept_order_id) {
                $acceptOrderId = $order->accept_order_id;
            }else{

                //STEP 2 - Accept Order Creation
                
                $acceptOrderId = $this->acceptOrderCreation($token, $order, $amount_cents);
                if(!$acceptOrderId){
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                   
                    return;
                }
            }

            //STEP 3 - Accept Payment Key Generation
            $result = $this->acceptPaymentKeyGeneration($token, $amount_cents, $acceptOrderId);
            if(!$result){
                alert()->info(trans('website.Wrong'), trans('website.Error Message'));
               
                return;
            }
            // Go to step 4 if payment is not visa/mastercard
            if(isset($paymentType)){

            //STEP 4 - Accept Pay Request

            $result = $this->acceptPayRequest($result, $paymentType, $identifier);

            }
            
        }

        return $result;


    }
    
}