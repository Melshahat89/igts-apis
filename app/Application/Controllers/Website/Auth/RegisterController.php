<?php

namespace App\Application\Controllers\Website\Auth;


use App\Application\Controllers\Controller;
use App\Application\Controllers\Traits\MainProcessTrait;
use App\Application\Model\Businessdata;
use App\Application\Model\Businessdomains;
use App\Application\Model\Businessuserspendingemails;
use App\Application\Model\Categories;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Social;
use App\Application\Model\User;
use App\Application\Model\UserInfo;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use  MainProcessTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'first_name' => 'required|max:255',
            // 'last_name' => 'required|max:255',
            'name' => 'required|max:255',
            'mobile' => 'required|max:15',
            // 'specialization' => 'required|max:255',
            'categories' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            // 'g-recaptcha-response' => 'required|recaptcha',

        ]);
    }

    protected function partnerValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            //'name' => 'required|max:255',
            'mobile' => 'required|max:15',
            // 'specialization' => 'required|max:255',
            //'categories' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'about' => 'required',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {


            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->mobile = $data['mobile'];
            // $user->first_name = json_encode([
            //     'en' => $data['first_name'],
            //     'ar' => $data['first_name']
            // ], JSON_UNESCAPED_UNICODE);
            // $user->last_name = json_encode([
            //     'en' => $data['last_name'],
            //     'ar' => $data['last_name']
            // ], JSON_UNESCAPED_UNICODE);
            //$user->specialization = $data['specialization'];
            //$user->sub_specialization = $data['sub_specialization'];
            //$user->other_specialization = $data['other_specialization'];
            
            $user->password = bcrypt($data['password']);
            $user->categories = $data['categories'];
            $user->group_id = env('DEFAULT_GROUP');
            $user->verified = (isset($data['facebook_identifier']) && !empty($data['facebook_identifier'])) ? 1 : 1;
            $user->activated = env('DEFAULT_activated');
            $user->activation_code = str_random(40);
            $user->businessdata_id = isset($data['businessdata_id']) ?$data['businessdata_id']:null ;
            
            $user->save();

            $userPending = Businessuserspendingemails::where('email', $data['email'])->first();

            if($userPending) {
                $userPending->delete();
            }
            
            

            if($data['facebook_identifier']){
                $user->facebook_identifier = $data['facebook_identifier'];

                $social = new social();
                $social->identifier = $data['facebook_identifier'];
                $social->provider = $data['provider'];
                $social->token = $data['token'];
                $social->user_id = $user->id;
                $social->save();
    
                }

                $user->save();

                $facebookConversionsApi = new FacebookConversionsAPI();
                $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_SIGNINSIGNUP);

                
                $category = Categories::find($data['categories']);

                if($category && $category->enable_free && $category->courses_id && $category->end_time){

                    enrollCourse($category->courses_id, $user->id, null, $category->end_time);
                }
                
                return $user;

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        // check if business
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

            $userPending = Businessuserspendingemails::where('email', $request->email)->first();

            if($userPending) {

                $businessdata = Businessdata::find($userPending->businessdata_id);

                if($businessdata){
                    
                    if($businessdata->CoutEnrollments <= $businessdata->licenses){
                        
                        $request->request->add(['businessdata_id' => $businessdata->id]);
                        
                        if(($businessdata->licenses - $businessdata->CoutEnrollments) <= 5){

                            $notifi =  User::addNotification([$businessdata->user_id], trans('website.The registration package is nearing completion'), trans('website.The registration package is nearing completion'), '/business/settings');

                        }

                    } else {

                        alert()->info(trans('website.Please contact your company for the end of the registration package'), trans('website.Success'));

                    }
                }
                

            }

            // $list = list($user, $domain) = explode('@', $request->email);
            // $businessdomains = 	Businessdomains::where('status',1)->where('domainname','=',$domain)->first();
            // if($businessdomains){
            //     $businessdata = Businessdata::where('status',1)->find($businessdomains->businessdata_id);
            //     if($businessdata){
                    
            //         if($businessdata->CoutEnrollments <= $businessdata->licenses){
            //             $request->request->add(['businessdata_id' => $businessdata->id]);
                       
            //             //Business Notification
            //             if(($businessdata->licenses - $businessdata->CoutEnrollments) <= 5){
            //                 $notifi =  User::addNotification([$businessdata->user_id], trans('website.The registration package is nearing completion'), trans('website.The registration package is nearing completion'), '/business/settings');
            //             }
                    
            //         }else{
            //             //Alert
            //             alert()->info(trans('website.Please contact your company for the end of the registration package'), trans('website.Success'));
            //         }
                    
            //     }
            // }
            
        }

        // dd($request);
        event(new Registered($user = $this->create($request->all())));



        if($user->facebook_identifier){
            Session::pull('socialUserRegister');
            // $this->guard()->login($user);

        }else{
            // $this->guard()->login($user);
            // Mail::to($user->email)->send(new VerifyMail($user, URL::previous()));
            // alert()->success(trans('website.We sent you an activation code. Check your email and click on the link to verify.'), trans('website.Success'));

        }

        $this->guard()->login($user);


        $category = Categories::find($request->get('categories'));
        $returnUrl = null;

        if($category && $category->enable_free && $category->courses_id && $category->end_time){

            $returnUrl = "/courses/category/" . $category->slug; 
        }


        return $this->registered($request, $user, $returnUrl)
            ?: redirect($this->redirectPath());
    }


    //partnership individual
    public function register_individual(Request $request)
    {

        $this->partnerValidator($request->all())->validate();
    
        $name = $request->all()['first_name'] . ' ' . $request->all()['last_name'];

        $request->request->add(['group_id' => User::TYPE_INDIVIDUAL]); //add request
        $request->request->add(['name' => $name]); //add request
        $request->request->add(['verified' => 0]); //add request
        $request->request->add(['activated' => 0]); //add request
        $request->request->add(['password' => bcrypt($request['password'])]); //add request


        $request->request->add(['first_name' => json_encode([
            'en' => $request['first_name'],
            'ar' => $request['first_name']
        ], JSON_UNESCAPED_UNICODE)]); //add request
        $request->request->add(['last_name' => json_encode([
            'en' => $request['last_name'],
            'ar' => $request['last_name']
        ], JSON_UNESCAPED_UNICODE)]); //add request

        $request->request->add(['instructorname' => json_encode([
            'en' => $request['instructorname'],
            'ar' => $request['instructorname']
        ], JSON_UNESCAPED_UNICODE)]); //add request

        $request->request->add(['about' => json_encode([
            'en' => $request['about'],
            'ar' => $request['about']
        ], JSON_UNESCAPED_UNICODE)]); //add request
        



        $user = app('App\Application\Controllers\Website\UserController')->storeOrUpdate($request , null , true);
        event(new Registered($user));
        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?  redirect('partnership/thankyou') : redirect('partnership/thankyou');
    }

    //partnership institution

    public function register_institution(Request $request)
    {

        $this->partnerValidator($request->all())->validate();

        $name = $request->all()['first_name'] . ' ' . $request->all()['last_name'];

        
        $request->request->add(['group_id' => User::TYPE_INSTITUTION]); //add request
        $request->request->add(['name' => $name]); //add request
        $request->request->add(['verified' => 0]); //add request
        $request->request->add(['activated' => 0]); //add request
        $request->request->add(['password' => bcrypt($request['password'])]); //add request

        $request->request->add(['first_name' => json_encode([
            'en' => $request['first_name'],
            'ar' => $request['first_name']
        ], JSON_UNESCAPED_UNICODE)]); //add request
        $request->request->add(['last_name' => json_encode([
            'en' => $request['last_name'],
            'ar' => $request['last_name']
        ], JSON_UNESCAPED_UNICODE)]); //add request

        $request->request->add(['instructorname' => json_encode([
            'en' => $request['instructorname'],
            'ar' => $request['instructorname']
        ], JSON_UNESCAPED_UNICODE)]); //add request

        $request->request->add(['about' => json_encode([
            'en' => $request['about'],
            'ar' => $request['about']
        ], JSON_UNESCAPED_UNICODE)]); //add request



        $user = app('App\Application\Controllers\Website\UserController')->storeOrUpdate($request , null , true);
        event(new Registered($user));
        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?  redirect('partnership/thankyou') : redirect('partnership/thankyou');
    }

    protected function registered(Request $request, $user, $returnUrl=null)
    {
        alert()->info(trans('website.Login successful'), trans('website.Success'));

        return ($returnUrl) ? redirect()->to($returnUrl) : redirect()->back();

    }


}
