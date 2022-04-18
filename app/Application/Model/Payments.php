<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $table = "payments";

    //operation enum values

    const OPERATION_DEPOSIT = 'Deposit';
    const OPERATION_FUND = 'Fund';
    const OPERATION_RELEASE = 'Release';
    const OPERATION_WITHDRAWAL = 'Withdrawal';
    const OPERATION_REFUND = 'Refund';
    const OPERATION_BONUS = 'Bonus';

    const PAYMENT_TYPE_OFFLINE = "Offline";
    
    //status enum values
    const STATUS_PENDING = 'Pending';
    const STATUS_SUCCEEDED = 'Succeeded';
    const STATUS_FAILED = 'Failed';
    const STATUS_CANCELED = 'Canceled';

    const ACCEPT_INTEGRATION_ID = '13972';  //   card integration_id test = 13972  live = 15187 will be provided upon signing up, test
    const ACCEPT_INTEGRATION_ID_KOISK = '19022';   //test = 19022 , live = 15360 , live = 14927
    const ACCEPT_INTEGRATION_ID_MOBILEWALLET = '132169'; //test = 129400 , live = 132169
    const ACCEPT_API_KEY = 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SndjbTltYVd4bFgzQnJJam80TURJekxDSnVZVzFsSWpvaWFXNXBkR2xoYkNJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaWZRLmxnakVuS1FjTHN4bnhkcFJJZTBWZkVjMEx2Q1pQTjBOS3JNeVJ1TUNrQkMwc2dNekNXSEZINXB5VnczRTZpVklja2kwMXZtc2dwRl9rR21mNGxCR2Rn';


    public function orders()
    {
        return $this->hasMany(Orders::class, "payments_id");
    }
    public function transactions()
    {
        return $this->hasMany(Transactions::class, "payments_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    protected $fillable = [
        'orders_id',
        'user_id', //sender_id
        'operation', 'amount', 'currency_id', 'receiver_id', 'token', 'token_date', 'status', 'accept_source_data_type', 'accept_id', 'accept_pending', 'accept_order', 'accept_amount_cents', 'accept_success', 'accept_data_message', 'accept_profile_id', 'accept_source_data_sub_type', 'accept_hmac', 'txn_response_code',

        'profit_percentage', 'profit',
    ];

    public static function exchangeRate()
    {

        // $ch = curl_init("https://free.currconv.com/api/v7/convert?q=USD_EGP&compact=ultra&apiKey=805ff2e426c2c65cd927");
        // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $data = curl_exec($ch);
        // $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // if (curl_errno($ch) == 0 and $http == 200) {
        //     $result = json_decode($data, true);
        //     $rate = isset($result['USD_EGP']) ? round($result['USD_EGP'], 2) : getSetting('USD_EGP');
        // } else {
        //     $rate = getSetting('USD_EGP');
        // }


        $rate = getSetting('USD_EGP');

        // $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

        // $ip_data = [];
        return $rate;

    }


    public static function acceptAuthentication(){
        $data = array(
            "api_key" => Payments::ACCEPT_API_KEY,
        );
        $postdata = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accept.paymobsolutions.com/api/auth/tokens",
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
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result ;
    }
    public static function acceptOrderCreation($postdata,$token){
        $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://accept.paymobsolutions.com/api/ecommerce/orders",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$token",
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

            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response, true);
            return $result ;
    }
    public static function acceptPaymentKeyGeneration($postdata,$token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accept.paymobsolutions.com/api/acceptance/payment_keys",
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

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result ;
    }

}
