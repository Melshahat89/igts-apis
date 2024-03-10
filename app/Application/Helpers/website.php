<?php

use App\Application\Model\Businessinputfields;
use App\Application\Model\Businessinputfieldsresponses;
use App\Application\Model\Categories;
use App\Application\Model\Ipcurrency;
use App\Application\Model\Courselectures;
use App\Application\Model\Courses;
use App\Application\Model\Payments;
use App\Application\Model\Slider;
use App\Application\Model\Coursewishlist;
use App\Application\Model\Events;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Orders;
use App\Application\Model\Progress;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Model\Subscriptionuser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


function page($id = null){
    if($id != null){
        return \App\Application\Model\Page::infOrFail($id);
    }
    return \App\Application\Model\Page::get();
}

function getYouTubeId($url){
    if (preg_match('![?&]{1}v=([^&]+)!', $url . '&', $m)){
        return $video_id = $m[1];
    }
    return false;
}

function menuCategories(){
    return Categories::where('status',1)->where('show_menu',1)->orderBy('sort','asc')->get();
}

function small($image = ''){

    if($image == ''){
        $image = url(env('NONE_IMAGE'));
    }else{
        $image = imageExist($image) ? url('/'.env('SMALL_IMAGE_PATH').'/'.$image) : large($image);
    }

    return $image;
    // return $image == '' ? env('NONE_IMAGE') : imageExist($image) ? url('/'.env('SMALL_IMAGE_PATH').'/'.$image) : large($image);
}

function getCertificateFromId($id){
    return Quizstudentsstatus::findOrFail($id)->certificate;
}

function imageExist($imageName , $env = 'SMALL_IMAGE_PATH'){
    return file_exists(env($env.'_1').'/'.$imageName) ? true : false;
}

function large($image= ''){
    if($image == ''){
        $image = url(env('NONE_IMAGE'));
    }else{
        $image = imageExist($image , 'MEDIUM_IMAGE_PATH') ?  url('/'.env('MEDIUM_IMAGE_PATH').'/'.$image) :  url(env('NONE_IMAGE'));
    }
    return $image ;

    // return $image == '' ? env('NONE_IMAGE') : imageExist($image , 'UPLOAD_PATH') ?  url('/'.env('UPLOAD_PATH').'/'.$image) :  env('NONE_IMAGE')  ;
}

function large1($image= ''){
    if($image == ''){
        $image = url(env('NONE_IMAGE'));
    }else{
        $image = imageExist($image , 'UPLOAD_PATH') ?  url('/'.env('UPLOAD_PATH').'/'.$image) :  url(env('NONE_IMAGE'));
    }
    return $image ;

    // return $image == '' ? env('NONE_IMAGE') : imageExist($image , 'UPLOAD_PATH') ?  url('/'.env('UPLOAD_PATH').'/'.$image) :  env('NONE_IMAGE')  ;
}

function medium($image= ''){
    if($image == ''){
        $image = url(env('NONE_IMAGE'));
    }else{
        $image = imageExist($image , 'MEDIUM_IMAGE_PATH') ?  url('/'.env('MEDIUM_IMAGE_PATH').'/'.$image) :  url(env('NONE_IMAGE'));
    }
    return $image ;

}

function CourseWishlisted($Course_id,$User_id = null){

    $User_id = Auth::guard('api')->user()->id;
    $Wishlist = Coursewishlist::where('user_id',$User_id)->where('courses_id',$Course_id)->exists();
    return $Wishlist;
}

// function getCurrency(){
//     $country = userCountry();
//     return  ($country["code"] == "EG" || $country["code"] == "MU") ? "EGP" : "USD";

// }

function getUserCountryByAPI($ip=null){

    $ip = ($ip) ? $ip : getUserIpAddr();
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://ipwhois.pro/json/" . $ip . "?key=wRRIhN7RYbL0KzPE",  // test : PO3Z57akwWMy84gf  Or test : wRRIhN7RYbL0KzPE
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);

    //set new ip currency details
    if($result){
        $ipCurrency = new Ipcurrency();
        $ipCurrency->ip = ($ip) ? $ip : getUserIpAddr();
        $ipCurrency->type = $result['type'] ? $result['type'] : null;
        $ipCurrency->continent = $result['continent'] ? $result['continent'] : null;
        $ipCurrency->continent_code = $result['continent_code'] ? $result['continent_code'] : null;
        $ipCurrency->country = $result['country'] ? $result['country'] : null;
        $ipCurrency->country_code = $result['country_code'] ? $result['country_code'] : null;
        $ipCurrency->country_flag = $result['country_flag'] ? $result['country_flag'] : null;
        $ipCurrency->region = $result['region'] ? $result['region'] : null;
        $ipCurrency->city = $result['city'] ? $result['city'] : null;
        $ipCurrency->timezone = $result['timezone'] ? $result['timezone'] : null;
        $ipCurrency->currency = $result['currency'] ? $result['currency'] : null;
        $ipCurrency->currency_code = $result['currency_code'] ? $result['currency_code'] : null;
        $ipCurrency->currency_rates = $result['currency_rates'] ? $result['currency_rates'] : null;
        $ipCurrency->save();
    }

    return $ipCurrency['currency_code']? $ipCurrency['currency_code']:null;
}

function userCountryAPI($ip=null){
    $ip = ($ip) ? $ip : getUserIpAddr();
    $response = getUserCountryByAPI($ip);

    if(isset($response)){
        switch($response) {
            case('EGP'):
                $currencyCode = 'EGP';
                break;

            case('AED'):
                $currencyCode = 'AED';
                break;

            case('SAR'):
                $currencyCode = 'SAR';
                break;

            default:
                $currencyCode = 'USD';
        }
        return $currencyCode;
    }else{
        return "USD";
    }

}

function getCurrency(){

    $userIpAddress = getUserIpAddr();

    $wordCount = DB::table('ipcurrency')->count();
    $currency =  Cache::remember('Ipcurrency-'.$wordCount, 216000, function() use ($userIpAddress) {
        return Ipcurrency::where('ip', $userIpAddress)->first();
    });

    //Old Code
//    $currency = Ipcurrency::where('ip',$userIpAddress)->first();
    if ($currency){
        switch($currency->currency_code) {
            case('EGP'):
                $currencyCode = 'EGP';
                break;

            case('AED'):
                $currencyCode = 'AED';
                break;

            case('SAR'):
                $currencyCode = 'SAR';
                break;

            default:
                $currencyCode = 'USD';
        }

        return $currencyCode;
    }else{
        return userCountryAPI($userIpAddress);
    }
}

function getCurrencyOld(){
    if(Session::get('ip') == getUserIpAddr() && Session::get('currency')){
        $currency = Session::get('currency');
    }else{
        $currency = userCountryAPI();
    }
    return $currency;
}

function userCountry2(){
    $ip = getUserIpAddr();



    $whitelist = array(
        '127.0.0.1',
        '::1'
    );

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $ip = '41.44.79.142'; //Egypt
        // $ip = '5.42.224.0'; //Saudi
    }




    // // Country Code
    // if(isset(getLocationInfoByIp($ip)['country_code'])){
    //     $countryCode = getLocationInfoByIp($ip)['country_code'];
    // }else{
    //     $countryCode = 'EG' ;
    // }

    // // country Name
    // if(isset(getLocationInfoByIp($ip)['country_name'])){
    //     $countryName = getLocationInfoByIp($ip)['country_name'];
    // }else{
    //     $countryName = 'EGYPT' ;
    // }

    // // country City
    // if(isset(getLocationInfoByIp($ip)['city'])){
    //     $countryCity = getLocationInfoByIp($ip)['city'];
    // }else{
    //     $countryCity = 'CAIRO' ;
    // }

    // Geo Location Free
    // Country Code
    if(isset(getLocationInfoByIp($ip)['geoplugin_countryCode'])){
        $countryCode = getLocationInfoByIp($ip)['geoplugin_countryCode'];
    }else{
        $countryCode = 'EG' ;
    }

    // country Name
    if(isset(getLocationInfoByIp($ip)['geoplugin_countryName'])){
        $countryName = getLocationInfoByIp($ip)['geoplugin_countryName'];
    }else{
        $countryName = 'EGYPT' ;
    }

    // country City
    if(isset(getLocationInfoByIp($ip)['geoplugin_city'])){
        $countryCity = getLocationInfoByIp($ip)['geoplugin_city'];
    }else{
        $countryCity = 'CAIRO' ;
    }




    // $countryCode = isset(getLocationInfoByIp($ip)['geoplugin_countryCode']) ?getLocationInfoByIp($ip)['geoplugin_countryCode'] :'EG' ;
    // $countryName = isset(getLocationInfoByIp($ip)['geoplugin_countryName']) ?getLocationInfoByIp($ip)['geoplugin_countryName'] :'EGYPT';
    // $countryCity = isset(getLocationInfoByIp($ip)['geoplugin_city']) ?getLocationInfoByIp($ip)['geoplugin_city'] :'CAIRO';
    if(!isset($countryCode))
        return array("code" => "EG", "country" => "EGYPT");

    return array("code" => $countryCode, "country" => $countryName, "city" => $countryCity);
}


function userCountry()
{
    $ip = getUserIpAddr();


    $whitelist = array(
        '127.0.0.1',
        '::1'
    );

    if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        //  $ip = '197.41.26.244'; //Egypt
        $ip = '5.42.224.0'; //Saudi
    }


    $ranges = array(
        '2.21.128.0-2.21.131.255',
        '23.50.192.0-23.50.207.255',
        '31.6.10.0-31.6.10.255',
        '34.99.146.0-34.99.147.255',
        '34.99.218.0-34.99.219.255',
        '34.103.133.3-34.103.133.9',
        '34.103.133.26-34.103.133.34',
        '34.103.133.36-34.103.133.69',
        '34.103.133.72-34.103.133.99',
        '34.103.133.254-34.103.133.254',
        '34.103.162.0-34.103.163.255',
        '34.103.206.1-34.103.206.1',
        '34.103.206.10-34.103.206.12',
        '34.103.206.100-34.103.206.119',
        '34.103.226.0-34.103.226.255',
        '34.124.72.0-34.124.72.255',
        '37.46.196.32-37.46.196.47',
        '41.32.0.0-41.47.255.255',
        '41.64.0.0-41.65.255.255',
        '41.67.80.0-41.67.87.255',
        '41.68.0.0-41.69.255.255',
        '41.72.64.0-41.72.95.255',
        '41.77.136.0-41.77.143.255',
        '41.78.22.0-41.78.22.255',
        '41.78.62.0-41.78.62.255',
        '41.78.148.0-41.78.151.255',
        '41.88.0.0-41.88.255.255',
        '41.91.0.0-41.91.255.255',
        '41.128.0.0-41.131.255.255',
        '41.152.0.0-41.153.255.255',
        '41.155.128.0-41.155.255.255',
        '41.176.0.0-41.176.255.255',
        '41.178.0.0-41.179.252.255',
        '41.187.0.0-41.187.255.255',
        '41.190.248.0-41.190.251.255',
        '41.191.80.0-41.191.83.255',
        '41.196.0.0-41.196.255.255',
        '41.199.0.0-41.199.255.255',
        '41.205.96.0-41.205.127.255',
        '41.206.128.0-41.206.159.255',
        '41.206.176.0-41.206.176.255',
        '41.206.189.0-41.206.189.49',
        '41.206.189.51-41.206.189.255',
        '41.209.192.0-41.209.255.255',
        '41.215.240.0-41.215.243.255',
        '41.217.160.0-41.217.191.255',
        '41.217.224.0-41.217.231.255',
        '41.218.128.0-41.218.191.255',
        '41.221.128.0-41.221.143.255',
        '41.221.222.0-41.221.223.255',
        '41.222.128.0-41.222.135.255',
        '41.222.168.0-41.222.175.255',
        '41.223.20.0-41.223.23.255',
        '41.223.52.0-41.223.55.255',
        '41.223.196.0-41.223.199.255',
        '41.223.240.0-41.223.243.255',
        '41.232.0.0-41.239.255.255',
        '45.96.0.0-45.111.255.255',
        '45.135.184.0-45.135.184.255',
        '45.195.86.0-45.195.86.255',
        '45.240.0.0-45.247.255.255',
        '57.83.0.0-57.83.15.255',
        '57.88.48.0-57.88.63.255',
        '57.188.16.0-57.188.16.255',
        '62.12.120.0-62.12.127.255',
        '62.68.224.0-62.68.255.255',
        '62.114.0.0-62.114.255.255',
        '62.117.32.0-62.117.63.255',
        '62.135.0.0-62.135.127.255',
        '62.139.0.0-62.139.255.255',
        '62.140.64.0-62.140.127.255',
        '62.193.64.0-62.193.127.255',
        '62.216.128.190-62.216.128.190',
        '62.216.128.194-62.216.128.194',
        '62.216.129.181-62.216.129.181',
        '62.216.129.185-62.216.129.185',
        '62.216.129.189-62.216.129.189',
        '62.216.129.193-62.216.129.193',
        '62.216.129.214-62.216.129.214',
        '62.216.129.218-62.216.129.218',
        '62.216.133.1-62.216.133.2',
        '62.216.133.17-62.216.133.18',
        '62.216.133.21-62.216.133.22',
        '62.216.148.0-62.216.149.255',
        '62.240.96.0-62.240.127.255',
        '62.241.128.0-62.241.159.255',
        '63.222.249.0-63.222.249.255',
        '63.223.12.5-63.223.12.6',
        '63.223.12.17-63.223.12.18',
        '63.223.12.21-63.223.12.22',
        '63.223.12.25-63.223.12.26',
        '63.223.12.29-63.223.12.30',
        '63.223.12.33-63.223.12.33',
        '63.223.12.45-63.223.12.45',
        '63.223.12.49-63.223.12.49',
        '63.223.12.53-63.223.12.53',
        '63.223.12.65-63.223.12.66',
        '64.71.138.152-64.71.138.159',
        '64.86.35.0-64.86.35.255',
        '64.86.186.17-64.86.186.17',
        '65.19.176.112-65.19.176.127',
        '69.24.246.64-69.24.246.79',
        '69.169.31.0-69.169.31.255',
        '69.169.89.240-69.169.89.255',
        '70.33.184.96-70.33.184.127',
        '70.33.186.160-70.33.186.191',
        '80.75.160.0-80.75.191.255',
        '80.77.0.0-80.77.0.32',
        '80.77.0.34-80.77.0.44',
        '80.77.0.46-80.77.0.64',
        '80.77.0.66-80.77.0.68',
        '80.77.0.70-80.77.0.72',
        '80.77.0.74-80.77.0.84',
        '80.77.0.86-80.77.0.120',
        '80.77.0.122-80.77.0.124',
        '80.77.0.126-80.77.0.128',
        '80.77.0.130-80.77.0.136',
        '80.77.0.138-80.77.0.148',
        '80.77.0.150-80.77.0.160',
        '80.77.0.162-80.77.0.255',
        '80.77.2.120-80.77.2.127',
        '80.77.2.160-80.77.3.255',
        '80.77.5.0-80.77.7.255',
        '80.77.12.0-80.77.13.255',
        '80.77.15.0-80.77.15.255',
        '81.10.0.0-81.10.127.255',
        '81.21.96.0-81.21.102.255',
        '81.21.106.0-81.21.111.255',
        '81.25.140.0-81.25.140.255',
        '81.29.97.0-81.29.97.255',
        '81.29.99.0-81.29.99.255',
        '81.29.105.0-81.29.107.255',
        '82.129.128.0-82.129.255.255',
        '82.195.187.22-82.195.187.22',
        '82.201.128.0-82.201.255.255',
        '84.11.144.64-84.11.144.127',
        '84.36.0.0-84.36.255.255',
        '84.205.96.0-84.205.127.255',
        '84.233.0.0-84.233.127.255',
        '85.205.124.0-85.205.124.255',
        '92.249.30.0-92.249.30.255',
        '95.100.16.0-95.100.31.255',
        '95.101.100.0-95.101.103.255',
        '102.8.0.0-102.15.255.255',
        '102.40.0.0-102.47.255.255',
        '102.56.0.0-102.63.255.255',
        '102.64.58.0-102.64.58.255',
        '102.68.22.0-102.68.22.255',
        '102.68.127.0-102.68.127.255',
        '102.69.149.0-102.69.150.255',
        '102.128.176.0-102.128.183.255',
        '102.131.32.0-102.131.35.255',
        '102.164.114.0-102.164.115.255',
        '102.164.122.0-102.164.122.255',
        '102.184.0.0-102.191.255.255',
        '102.223.144.0-102.223.147.255',
        '102.223.172.0-102.223.172.255',
        '102.223.242.0-102.223.243.255',
        '102.223.250.0-102.223.250.255',
        '103.111.60.0-103.111.60.255',
        '104.44.36.217-104.44.36.217',
        '104.44.36.219-104.44.36.219',
        '104.44.40.24-104.44.40.25',
        '104.44.238.199-104.44.238.199',
        '104.44.239.49-104.44.239.49',
        '104.44.239.51-104.44.239.51',
        '104.44.239.53-104.44.239.53',
        '104.133.45.0-104.133.45.255',
        '104.245.124.48-104.245.124.63',
        '105.32.0.0-105.42.195.255',
        '105.42.197.0-105.47.255.255',
        '105.80.0.0-105.95.255.255',
        '105.180.0.0-105.183.255.255',
        '105.192.0.0-105.207.255.255',
        '107.153.84.0-107.153.87.255',
        '114.198.235.0-114.198.236.255',
        '114.198.239.0-114.198.239.255',
        '137.83.225.64-137.83.225.70',
        '137.83.226.64-137.83.226.70',
        '137.83.227.64-137.83.227.70',
        '146.252.122.0-146.252.122.255',
        '154.128.0.0-154.143.255.255',
        '154.176.0.0-154.191.255.255',
        '154.236.0.0-154.238.8.255',
        '154.238.10.0-154.239.255.255',
        '155.11.0.0-155.11.255.255',
        '155.12.128.0-155.12.191.255',
        '156.160.0.0-156.223.255.255',
        '157.167.81.0-157.167.81.255',
        '160.119.77.0-160.119.77.255',
        '162.158.129.0-162.158.131.255',
        '162.252.56.16-162.252.56.23',
        '163.121.0.0-163.121.255.255',
        '164.160.64.0-164.160.67.255',
        '164.160.104.0-164.160.107.255',
        '165.1.193.64-165.1.193.127',
        '169.239.37.0-169.239.37.255',
        '184.29.4.0-184.29.5.255',
        '185.125.226.35-185.125.226.35',
        '185.125.227.35-185.125.227.35',
        '185.133.16.0-185.133.19.255',
        '185.163.110.160-185.163.110.191',
        '185.187.178.0-185.187.178.255',
        '188.214.122.0-188.214.122.255',
        '192.101.142.0-192.101.142.255',
        '192.198.120.0-192.198.120.255',
        '193.19.232.0-193.19.235.255',
        '193.227.0.0-193.227.63.255',
        '193.227.128.0-193.227.128.255',
        '194.79.96.0-194.79.127.255',
        '195.43.0.0-195.43.31.255',
        '195.234.168.0-195.234.168.255',
        '195.234.185.0-195.234.185.255',
        '195.234.252.0-195.234.255.255',
        '195.246.32.0-195.246.63.255',
        '196.1.143.0-196.1.143.255',
        '196.2.192.0-196.2.223.255',
        '196.6.185.0-196.6.185.255',
        '196.6.236.0-196.6.236.255',
        '196.10.97.0-196.10.97.255',
        '196.10.120.0-196.10.120.255',
        '196.12.11.0-196.12.11.255',
        '196.13.206.0-196.13.206.255',
        '196.13.244.0-196.13.244.255',
        '196.13.253.0-196.13.253.255',
        '196.20.32.0-196.20.63.255',
        '196.22.5.0-196.22.5.255',
        '196.22.7.0-196.22.7.255',
        '196.22.130.0-196.22.130.255',
        '196.41.73.0-196.41.73.255',
        '196.41.83.0-196.41.83.255',
        '196.43.198.0-196.43.198.255',
        '196.43.201.0-196.43.201.255',
        '196.43.219.0-196.43.219.255',
        '196.43.237.0-196.43.237.255',
        '196.46.22.0-196.46.22.255',
        '196.46.188.0-196.46.191.255',
        '196.50.22.0-196.50.23.255',
        '196.128.0.0-196.159.255.255',
        '196.201.3.0-196.201.3.255',
        '196.201.25.0-196.201.26.255',
        '196.201.28.0-196.201.28.255',
        '196.201.240.0-196.201.247.255',
        '196.202.0.0-196.202.127.255',
        '196.204.0.0-196.204.27.255',
        '196.204.28.128-196.205.255.255',
        '196.216.24.0-196.216.31.255',
        '196.216.140.0-196.216.143.255',
        '196.216.206.0-196.216.206.255',
        '196.216.240.0-196.216.241.255',
        '196.216.246.0-196.216.246.255',
        '196.216.252.0-196.216.252.255',
        '196.218.0.0-196.218.247.255',
        '196.219.0.0-196.219.247.255',
        '196.221.0.0-196.221.255.255',
        '196.223.7.0-196.223.7.255',
        '196.223.16.0-196.223.17.255',
        '197.32.0.0-197.63.255.255',
        '197.120.0.0-197.127.255.255',
        '197.132.0.0-197.135.255.255',
        '197.150.0.0-197.151.255.255',
        '197.160.0.0-197.160.233.255',
        '197.160.235.0-197.160.236.255',
        '197.160.240.0-197.167.255.255',
        '197.192.0.0-197.199.255.255',
        '197.222.0.0-197.223.255.255',
        '197.246.0.0-197.246.255.255',
        '199.95.178.0-199.95.179.255',
        '205.251.93.0-205.251.94.15',
        '207.46.35.212-207.46.35.213',
        '208.29.92.52-208.29.92.52',
        '208.127.8.0-208.127.8.255',
        '208.127.18.0-208.127.20.255',
        '208.127.96.64-208.127.96.70',
        '208.127.97.64-208.127.97.70',
        '208.127.98.64-208.127.98.70',
        '208.127.99.64-208.127.99.70',
        '208.127.100.64-208.127.100.70',
        '208.127.101.64-208.127.101.70',
        '208.127.104.64-208.127.104.70',
        '208.127.248.73-208.127.248.108',
        '209.88.146.0-209.88.154.255',
        '209.120.224.144-209.120.224.147',
        '212.12.224.0-212.12.234.79',
        '212.12.234.88-212.12.255.255',
        '212.60.14.0-212.60.14.255',
        '212.103.160.0-212.103.190.255',
        '212.103.191.16-212.103.191.255',
        '212.122.224.0-212.122.255.255',
        '213.131.64.0-213.131.95.255',
        '213.152.64.0-213.152.95.255',
        '213.154.32.0-213.154.63.255',
        '213.158.160.0-213.158.191.255',
        '213.181.224.0-213.181.255.255',
        '213.182.201.0-213.182.201.255',
        '213.212.192.0-213.212.255.255',
        '213.242.116.10-213.242.116.10',
        '216.218.193.8-216.218.193.8',
        '216.218.193.11-216.218.193.11',
        '216.218.207.160-216.218.207.160',
        '216.218.207.162-216.218.207.191',
        '217.20.224.0-217.20.239.255',
        '217.52.0.0-217.55.255.255',
        '217.139.0.0-217.139.255.255'


    );

    foreach ($ranges as $range) {
        $ok = ip_in_range($ip, $range);

        if($ok){
            // dd(11);
            return array("code" => "EG", "country" => "EGYPT");
        }
    }

    return array("code" => "OTH", "country" => "OTHER");

}

function getLocationInfoByIp($ip){

    $ch = curl_init("http://www.geoplugin.net/json.gp?ip=".$ip);
    // $ch = curl_init("http://api.ipstack.com/".$ip."?access_key=e5b8421fe448d08f14972f2c34d35317&format=1");
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if(curl_errno($ch) == 0 AND $http == 200) {
        $ip_data = json_decode($data, true);
    }else{
        $ip_data = [];
    }

    // $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    // $ip_data = [];
    return $ip_data;

}


function getUserIpAddr(){

    $whitelist = array(
        '127.0.0.1',
        '::1'
    );

    if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
//        $ip = '41.222.128.0'; //Egypt
        $ip = '103.84.120.1'; //Saudi
//        $ip = '206.71.50.230'; //USA
//        $ip = '83.110.250.231'; //Dubai
    }else{

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }

    return $ip;
}

function createRandomCode() {

    $chars = "I02G34T567S89";
    srand((double)microtime()*1000000);
    $i = 0;
    $code = '' ;

    while ($i <= 15) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $code = $code . $tmp;
        $i++;
    }

    return $code;

}

function sliders(){
    return Slider::where('status',1)->get();
}

function getEventStatus($data){

    $currentDate = new DateTime("now", new DateTimeZone('Egypt'));
    $currentDate = $currentDate->format('Y-m-d H:i:s');

    //$startDate = new DateTime($data->start_date);
    //$startDate = $startDate->format('Y-m-d h:i:s');

    $startDate = $data->start_date;

    // if($data->end_date == null){
    //     return "going";
    // }

    $endDate = new DateTime($startDate);
    $endDate = $endDate->add(new DateInterval('PT3H'));
    $endDate = $endDate->format('Y-m-d H:i:s');


    $passed = false;
    $going = false;


    if($currentDate > $startDate){


        if($currentDate < $endDate){


            $going = true;

            return "going";

        }else{

            $passed = true;
            return "passed";
        }



    }else{

        $passed = false;
        return "not started";
    }


}

function getBusinessInputFieldResponses($inputfield_id, $user_id) {

    return Businessinputfieldsresponses::where('businessinputfields_id', $inputfield_id)->where('user_id', $user_id)->first();

}

function hasProgressed($user_id, $lecture_id) {



    $lecture = Courselectures::find($lecture_id);

    $progress = Progress::where('user_id', $user_id)->where('courselectures_id', $lecture_id)->first();

    if($lecture->event_id) {

        return 1;

    } else {

        if($progress) {

            return 1;

        } else {

            return 0;
        }
    }
}

function charlimit($string, $limit) {

    return mb_substr($string, 0, $limit, 'utf-8') . (strlen($string) > $limit ? "..." : '');
}

function localizeDate($datetime){

    $datetimeformat = new DateTime($datetime);
    $day = $datetimeformat->format('d');
    $month = $datetimeformat->format('F');

    switch ($month){
        case 'January':
            $month = 'يناير';
            break;
        case 'February':
            $month = 'فبراير';
            break;
        case 'March':
            $month = 'مارس';
            break;
        case 'April':
            $month = 'ابريل';
            break;
        case 'May':
            $month = 'مايو';
            break;
        case 'June':
            $month = 'يونيو';
            break;
        case 'July':
            $month = 'يوليو';
            break;
        case 'August':
            $month = 'اغسطس';
            break;
        case 'September':
            $month = 'سبتمبر';
            break;
        case 'October':
            $month = 'اكتوبر';
            break;
        case 'November':
            $month = 'نوفبمر';
            break;
        case 'December':
            $month = 'ديسمبر';
            break;
    }

    return $day . " " . $month;

}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function initPaginate(Collection $results, $showPerPage)
{
    $pageNumber = Paginator::resolveCurrentPage('page');
    $totalPageNumber = $results->count();

    return initPaginator($results->forPage($pageNumber, $showPerPage), $totalPageNumber, $showPerPage, $pageNumber, [
        'path' => Paginator::resolveCurrentPath(),
        'pageName' => 'page',
    ]);

}

/**
 * Create a new length-aware paginator instance.
 *
 * @param  \Illuminate\Support\Collection  $items
 * @param  int  $total
 * @param  int  $perPage
 * @param  int  $currentPage
 * @param  array  $options
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
function initPaginator($items, $total, $perPage, $currentPage, $options)
{
    return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
        'items', 'total', 'perPage', 'currentPage', 'options'
    ));
}


function getInstructors($course){

    $instructors = array();

    foreach($course->coursesincluded as $included){
        if($included->instructor->id != $course->instructor->id)
            $instructors[] = $included->instructor;
    }

    $instructors = array_unique($instructors);

    return $instructors;
}
function tabsContainerItemsWidth(){

    $courses = (Courses::where('type', Courses::TYPE_COURSE)->where('published', 1)->where('soon', 0)->count() > 0) ? 1 : 0;
    $diplomas = (Courses::where('type', Courses::TYPE_DIPLOMAS)->where('published', 1)->where('soon', 0)->count() > 0) ? 1 : 0;
    $masters = (Courses::where('type', Courses::TYPE_MASTERS)->where('published', 1)->where('soon', 0)->count() > 0) ? 1 : 0;
    $bundles = (Courses::where('type', Courses::TYPE_BUNDLES)->where('published', 1)->where('soon', 0)->count() > 0) ? 1 : 0;
    $events = (Events::where('status', 1)->count() > 0) ? 1 : 0;

    $sum = $courses + $diplomas + $masters + $bundles + $events;

    switch ($sum) {
        case 1:
            $percentage = '20';
            break;
        case 2:
            $percentage = '30';
            break;
        case 3:
            $percentage = '40';
            break;
        case 4:
            $percentage = '50';
            break;
        case 5:
            $percentage = '60';
            break;

        default:
            $percentage = '20';
    }

    return $percentage;




}

function extractSeoKeys($arr){

    return str_replace(['[', ']', '"'], '', $arr);
}

function defaultSeoKeys($title){

    return str_replace(' ', ', ', $title);
}

function getCourseTypeText($course){


    switch ($course->type){

        case Courses::TYPE_COURSE:
            $type = 'courses';
            break;

        case Courses::TYPE_DIPLOMAS:
            $type = 'diplomas';
            break;

        case Courses::TYPE_MASTERS:
            $type = 'masters';
            break;

        case Courses::TYPE_BUNDLES:
            $type = 'bundles';
            break;

        default:
            $type = 'courses';
    }

    return $type;
}

function timeLength($sec)
{
    $s=$sec % 60;
    $m=(($sec-$s) / 60) % 60;
    $h=floor($sec / 3600);
    return $h.":".substr("0".$m,-2).":".substr("0".$s,-2);
}

function currentYear(){

    $now = Carbon::now();

    return $now->year;
}

function sortCourses($items){

    if(request()->has('sort') && request()->get('sort') == 1){
        $items = $items->orderBy('created_at', 'ASC');
    }else{
        $items = $items->orderBy('created_at', 'DESC');
    }

    return $items;
}

function filterCriteria($items){


    if (request()->has('rating') && request()->get('rating') != '') {
        $data['rating'] = $_GET['rating'];
        $items = $items->filter(function ($item) use($data) {

            if ($item->CourseRating > ((int) $data['rating'] - 1) and $item->CourseRating <= (int) $data['rating']) {
                return $item;
            }
        });
    } else {
        $data['rating'] = '';
    }

    if (request()->has('duration') && request()->get('duration') != '') {
        $duration = explode(":", request()->get('duration'));
        //dd($duration);
        $items = $items->filter(function ($item) use ($duration) {
            if (($item->CourseDuration > ($duration[0] * 60 * 60)) and ($item->CourseDuration <= ($duration[1] * 60 * 60))) {
                return $item;
            }
        });
        $data['duration'] = $_GET['duration'];
    } else {
        $data['duration'] = '';
    }

    $data['categories'] = '';
    return ['items' => $items, 'criteria' => $data];
}


function liveWireFilterCriteria($items, $criteria){
    if ($criteria['rating']) {
        $data['rating'] = $criteria['rating'];
        $items = $items->filter(function ($item) use($data) {
            if ($item->CourseRating > ((int) $data['rating'] - 1) and $item->CourseRating <= (int) $data['rating']) {
                return $item;
            }
        });
    } else {
        $data['rating'] = '';
    }

    if ($criteria['duration']) {
        $duration = explode(":", $criteria['duration']);
        $items = $items->filter(function ($item) use ($duration) {
            if (($item->CourseDuration > ($duration[0] * 60 * 60)) and ($item->CourseDuration <= ($duration[1] * 60 * 60))) {
                return $item;
            }
        });
        $data['duration'] = $criteria['duration'];
    } else {
        $data['duration'] = '';
    }

    if ($criteria['speciality']) {
        $speciality = $criteria['speciality'];
        $items = $items->filter(function ($item) use ($speciality) {
            if ($item->categories->slug == $speciality) {
                return $item;
            }
        });
        $data['speciality'] = $criteria['speciality'];
    } else {
        $data['speciality'] = '';
    }

    $data['categories'] = '';
    return ['items' => $items, 'criteria' => $data];
}

function getCurrentandNextMonthNumbers(){
    $currentMonth = Carbon::now()->month;
    $nextMonth = $currentMonth + 1;

    if($nextMonth > 12){
        $result = [
            $currentMonth,
            $nextMonth - 12
        ];
    }else{
        $result = [
            $currentMonth,
            $nextMonth
        ];
    }

    return $result;
}

function durationCalc($duration){
    if($duration >= 3600){
        return gmdate("H:i:s",$duration);
    }else{
        return gmdate("i:s",$duration);
    }

}

function calculateExchangeRate($currency, $amount, $method){

    if($method == Orders::METHOD_PAYMOB)
        $amount = ceil($amount) * 100;




    return ceil(($currency == "EGP") ? $amount : Payments::exchangeRate() * $amount);
//    return ceil($amount / $currency->ExchangeRateOnPayment);
}

function checkSubscriptionActive($subscriptionID){
    $now = Carbon::now()->toDateString();
    return Subscriptionuser::where('id',$subscriptionID)
        ->where('is_active',1)
        ->where('b_type',Orders::TYPE_B2C)
        ->where(function($query) use ($now){
            $query->where('end_date', '>=', date($now))
                ->where('start_date', '<=', date($now));
        })
        ->latest()->first();
}