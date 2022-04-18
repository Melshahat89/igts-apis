<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(!Auth::check()){
            return redirect('/login');
        }
        if(Auth::user()->group_id != 1 AND Auth::user()->group_id != 9 AND Auth::user()->group_id != 10 AND Auth::user()->group_id != 11 AND Auth::user()->group_id != 12 AND Auth::user()->group_id != 13 AND Auth::user()->group_id != 14 AND Auth::user()->group_id != 15 AND Auth::user()->group_id != 16)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
