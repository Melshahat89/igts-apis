<?php

namespace App\Application\Controllers\Website\Auth;

use App\Application\Controllers\Controller;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\UserInfo;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated(Request $request, $user)
    {


        if (!$user->verified) {
            $this->guard()->logout();
            alert()->info(trans('website.You need to confirm your account. We have sent you an activation code, please check your email.'), trans('website.Success'));
            return redirect()->back();
        }

        $facebookConversionsApi = new FacebookConversionsAPI();
        $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_SIGNINSIGNUP);

        Auth::logoutOtherDevices(request('password'));

        if($request->route()->getActionMethod() != 'complete' AND $request->route()->getActionMethod() != 'update'){
            if(Auth::check()){
                // if(Auth::user()->group_id == 2 AND (is_null(Auth::user()->mobile) OR is_null(Auth::user()->categories)) ){
                //     alert()->warning("You need to complete your profile to be able to continue surfing the website. <a href='https://meduo.net/account/complete'> Complete Now </a>" , trans('website.Error Message'))->html();

                // }
            }
        }    


        // if($request->route()->getActionMethod() != 'complete' AND $request->route()->getActionMethod() != 'update'){
        //     if(Auth::check()){
        //         if(Auth::user()->group_id == 2 AND (is_null(Auth::user()->mobile) OR is_null(Auth::user()->categories)) ){
        //             alert()->warning("You need to complete your profile to be able to continue surfing the website. <a href='https://meduo.net/account/complete'> Complete Now </a>" , trans('website.Error Message'))->html();

        //         }
        //     }
        // }  

        if ($user->group_id == 1) {
            return redirect()->back();
        }

        if ($user->group_id == 4 OR $user->group_id == 5) {
            //return redirect('/partnership');

            return redirect()->back();
        }

        return redirect()->back();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->back();
    }


    public function lazyadmin_login_view()
    {
        return view('auth.admin-login');
    }

    public function lazyadmin_login(Request $request)
    {
        $this->validateLogin($request);


        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponseAdmin($request);
        }

        

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }



    protected function sendLoginResponseAdmin(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return $this->authenticatedAdmin($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }


    protected function authenticatedAdmin(Request $request, $user)
    {
        if (!$user->verified) {
            $this->guard()->logout();
            alert()->info(trans('website.You need to confirm your account. We have sent you an activation code, please check your email.'), trans('website.Success'));
            return redirect()->back();
        }

        if ($user->businessdata_id) {
            return redirect('/business/businessCourses');
        }
        if ($user->group_id == 6) {
            return redirect('/business/home');
        }

        if ($user->group_id != 1) {
            $this->guard()->logout();
            return redirect('/login');
        }
        Auth::logoutOtherDevices(request('password'));
        if ($user->group_id == 1) {
            return redirect('/lazyadmin');
        }
        return redirect()->back();
        return redirect('/');
    }


    public function businessLogin(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponseAdmin($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
