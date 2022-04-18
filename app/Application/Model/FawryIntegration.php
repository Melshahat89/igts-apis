<?php
namespace App\Application\Model;

use App\Application\Model\PaymentIntegrations;
use Illuminate\Support\Facades\Auth;

class FawryIntegration extends PaymentIntegrations{

    const FAWRY_LIVE_INTEGRATION_ID = "e/cPi9FZ3jWEYUJbW98mYA==";
    const FAWRY_TEST_INTEGRATION_ID = "1tSa6uxz2nSlWR9h5SDdDA==";
    const FAWRY_LIVE_INTEGRATION_URL = "https://atfawry.com/ECommerceWeb/Fawry/payments/charge";
    const FAWRY_TEST_INTEGRATION_URL = "https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/payments/charge";
    const FAWRY_LIVE_SECRET_KEY = "6012b8475154417c90378c43a03096c6";
    const FAWRY_TEST_SECRET_KEY = "2b4d5f2aee6743eda614038ea0547d49";

    protected function callAPI($postdata, $URL, $token = null)
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
            // CURLOPT_POSTFIELDS => $dd,

            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        return $result;
        
    }

    function fawryAuthentication($order, $amount_cents){

        $merchantCode    = FawryIntegration::FAWRY_LIVE_INTEGRATION_ID;
        $merchantRefNum  = $order->id;
        $merchant_cust_prof_id  = Auth::user()->id;
        $payment_method = 'PayAtFawry';
        $amount = number_format(($amount_cents / 100), 2);
        $merchant_sec_key =  FawryIntegration::FAWRY_LIVE_SECRET_KEY;
        $signature = hash('sha256', $merchantCode . $merchantRefNum . $merchant_cust_prof_id . $payment_method . $amount . $merchant_sec_key);

        $data = [
            "merchantCode" => $merchantCode,
            "merchantRefNum" => $merchantRefNum,
            "customerName" => (Auth::user()->fullname_lang) ? Auth::user()->fullname_lang : 'NA',
            "customerMobile" => (Auth::user()->phone) ? Auth::user()->phone : 'NA',
            "customerEmail" => (Auth::user()->email) ? Auth::user()->email : 'NA',
            "customerProfileId" => $merchant_cust_prof_id,
            "amount" => $amount,
            "currencyCode" => "EGP",
            "language" => "ar-eg",

            "chargeItems" => [array(
                "itemId" => $order->id,
                "description" => "Meduo Course/s",
                "price" => $amount,
                "quantity" => count($order->ordersposition),
            )],
            "signature" => $signature,
            "paymentMethod" => $payment_method,

        ];
        $postdata = json_encode($data);

        $result = $this->callAPI($postdata, FawryIntegration::FAWRY_LIVE_INTEGRATION_URL);

        if (!isset($result['referenceNumber'])) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        return $result['referenceNumber'];
    }

    public function init($order, $amount_cents,$paymentType=null, $identifier=null)
    {

        if ($order->fawryRefNumber) {
            $payment_data = $order->fawryRefNumber;
        } else {

        //STEP 1 - Accept Authentication
        $refNumber = $this->fawryAuthentication($order, $amount_cents);
        $order->fawryRefNumber = $refNumber;
        $order->save();
        $payment_data = $order->fawryRefNumber;

        }
        
            
        return $payment_data;
    }
}