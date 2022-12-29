<?php

namespace App\Application\Controllers;

use App\Application\Model\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {

        // Check if profile completed
        $this->middleware(function ($request, $next) {
            // if($request->route()->getActionMethod() != 'otp' AND $request->route()->getActionMethod() != 'sendOtp'){
            //     if(Auth::check()){
            //         // if(Auth::user()->group_id == 2 AND (is_null(Cookie::get('MeduoCookie')) ) AND (Cookie::get('MeduoCookie') != Auth::user()->otp) ){

            //         if(Auth::user()->group_id == 2 AND (is_null(Cookie::get('MeduoCookie')) ) ){
            //              return redirect('account/otp');
            //             // dd( Cookie::get('MeduoCookie'));
            //             alert()->error(trans('website.The current password is incorrect') , trans('website.Error Message'));
            //         }
            //     }
            // }            
            return $next($request);
        });
       

    }
}
