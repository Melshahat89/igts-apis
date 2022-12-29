<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        dd($request->header("Accept-Language"));
        /**
         * requests hasHeader is used to check the Accept-Language header from the REST API's
         */
        if ($request->hasHeader("Accept-Language")) {
            /**
             * If Accept-Language header found then set it to the default locale
             */
            App::setLocale($request->header("Accept-Language"));
        }
        if(app()->getLocale() != 'en'){
            App::setLocale("ar");
        }
        return $next($request);
    }
}
