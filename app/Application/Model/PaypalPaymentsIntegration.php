<?php

namespace App\Application\Model;

use Illuminate\Support\Facades\Auth;

class PaypalPaymentsIntegration {


    const PAYPAL_TEST_URL = "https://api-m.sandbox.paypal.com/";
    const PAYPAL_LIVE_URL = "https://api-m.paypal.com/";
    
    const PAYPAL_ORDERS_HANLDER = "v2/checkout/orders";
    const PAYPAL_TOKEN_HANDLER = "v1/oauth2/token";
    const PAYPAL_PAYPMENT_HANDLER = "v2/payments/authorizations";

    const PAYPAL_TEST_CLIENT_ID = "AcM4Ugk3-xKFMYXHE2sQtbytYXd2piXjDpgL57a-LK3EVd2xQSwWOrMRSaKbaPa5pnl8QynmYRYEKOsJ";
    const PAYPAL_TEST_CLIENT_SECRET = "EChe6bc7dCpkfgsa5gZvQoKTRv6XZd5QMO4_mZh8X8VeQZw5eZKNGtGyO4N8XMAXQrc2es-53p5fcdPz";
    
    const PAYPAL_LIVE_CLIENT_ID = "AVtkKmsou3z4sPc8HtO0olSHH9vLg4GHYi8k7vFUiP0MzdwRsM-Fr3xNUKYMsVo9wBLcug3CKp-_md7Y";
    const PAYPAL_LIVE_SECRET = "EJpRHZE95mpIyVvQ9EltNlPjqE1MgiaxCQSyA_14CQ20JebI7ukZMWjnqC6VbEqTtGTQ5UVcca32Kd2i";

    protected function callAPI($postdata, $URL, $token=null)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postdata,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token,
            ),
        ));

        
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result ;
        
    }


    function getAccessToken(){

        //dd(PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_TOKEN_HANDLER);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_TOKEN_HANDLER,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => PaypalPaymentsIntegration::PAYPAL_TEST_CLIENT_ID . ":" . PaypalPaymentsIntegration::PAYPAL_TEST_CLIENT_SECRET,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        //dd($response);

        if (!isset($response->access_token)) {
           
            return false;
        }

        return $response->access_token;
    }

    function checkoutOrder($token, $orderID=null){

        $amount = getShoppingCartCost();
        $order = ($orderID) ? Orders::findOrFail($orderID) : getCurrentOrder();
        $arr = null;
        //$arr = ["reference_id" => $order->id];
        foreach($order->ordersposition as $item){
            
            $amount = $item->amount;

            if($orderID){
                if($item->currency != "USD"){

                    $exchangeRate = Payments::exchangeRate();
                    $amount = round($amount / $exchangeRate);
                }
            }else{
                if(getCurrency() != "USD"){

                    $exchangeRate = Payments::exchangeRate();
                    $amount = round($amount / $exchangeRate);
                }
            }

            $arr[] = array(
                "reference_id" => $item->id,
                "custom_id" => $order->id,
                "amount" => array(
                    "currency_code" => "USD",
                    "value" => $amount,
                )
            );

        }
        
        $data = array(
            "intent" => "CAPTURE",
            "purchase_units" =>  $arr,
            "payee" => Auth::user()->email,
            "application_context" => array(
                "return_url" => "http://localhost:8000/payments/paypalconfirmation/" . $order->id,
            )
        );

        $postdata = json_encode($data);
        
        //dd(json_decode($postdata));

        $response =  $this->callAPI($postdata, PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_ORDERS_HANLDER, $token);

        //dd($response);
        
        if (!isset($response['status']) || $response['status'] != "CREATED") {
            return false;
        }
        
        //dd($response);
        return ['response' => $response, 'data' => $postdata];
    }

    function captureOrder($orderId){

        $token = $this->getAccessToken();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_ORDERS_HANLDER . "/" . $orderId . "/capture",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token,
            ),
        ));
        
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        if (!isset($response->status) || $response->status != "COMPLETED") {
            return false;
        }

        //dd($response);
        return $response;
    }

    function getPaypalOrder($paypalOrderId){

        $token = $this->getAccessToken();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_ORDERS_HANLDER . "/" . $paypalOrderId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token,
            ),
        ));
        
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response;
        
    }

    function recordPayment($payerID, $token){

        $token = $this->getAccessToken();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => PaypalPaymentsIntegration::PAYPAL_TEST_URL . PaypalPaymentsIntegration::PAYPAL_PAYPMENT_HANDLER . "/" . $payerID,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token,
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

    }

    public function init($orderID=null){

        $accessToken = $this->getAccessToken();

        if(!$accessToken){
            return false;
        }

        $orderCreated = ($orderID) ? $this->checkoutOrder($accessToken, $orderID) : $this->checkoutOrder($accessToken);

        if(!$orderCreated){
            return false;
        }

        return $orderCreated['response'];

        //$paymentResult = $this->recordPayment($orderCreated['response']['links'][3]['href'], $accessToken, $orderCreated['data']);

    }

}