<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businessdata;
use App\Application\Model\Businessdomains;
use App\Application\Model\Social;
use App\Application\Model\User;
use App\Application\Requests\Website\Social\AddRequestSocial;
use App\Application\Requests\Website\Social\UpdateRequestSocial;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session as Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\URL;
use stdClass;



class SocialController extends AbstractController
{

    public function __construct(Social $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $items = $this->model;

        if (request()->has('from') && request()->get('from') != '') {
            $items = $items->whereDate('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $items = $items->whereDate('created_at', '<=', request()->get('to'));
        }

        if (request()->has("user_id") && request()->get("user_id") != "") {
            $items = $items->where("user_id", "=", request()->get("user_id"));
        }

        if (request()->has("provider") && request()->get("provider") != "") {
            $items = $items->where("provider", "=", request()->get("provider"));
        }

        if (request()->has("identifier") && request()->get("identifier") != "") {
            $items = $items->where("identifier", "=", request()->get("identifier"));
        }

        if (request()->has("profile_cache") && request()->get("profile_cache") != "") {
            $items = $items->where("profile_cache", "=", request()->get("profile_cache"));
        }

        if (request()->has("session_data") && request()->get("session_data") != "") {
            $items = $items->where("session_data", "=", request()->get("session_data"));
        }



        $items = $items->paginate(env('PAGINATE'));
        return view('website.social.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.social.edit', $id);
    }

    public function store(AddRequestSocial $request)
    {
        $item =  $this->storeOrUpdate($request, null, true);
        return redirect('social');
    }

    public function update($id, UpdateRequestSocial $request)
    {
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();
    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.social.show', $id, ['fields' =>  $fields]);
    }

    public function destroy($id)
    {
        return $this->deleteItem($id, 'social')->with('sucess', 'Done Delete Social From system');
    }

    public function redirect($service)
    {
        Session::put('backUrl', URL::previous());
        return Socialite::driver($service)->redirect();
    }
    public function callback($service)
    {


        if($service == 'google' OR $service == 'linkedin'){

            // return Socialite::driver('google')->stateless()->redirect();

            $fbuser = Socialite::driver($service)->stateless()->user();
            // dd($fbuser = Socialite::driver($service)->user());
            // dd(Socialite::driver('google') ->setScopes(['openid', 'email']));
            // $fbuser = Socialite::driver($service)->stateless()->user();
        }else{
            $fbuser = Socialite::driver($service)->user();  
        }

        // $fbuser = Socialite::driver($service)->stateless()->user();
        
        $account = User::where('facebook_identifier', $fbuser->id)->first();

        if ($fbuser->getEmail()){
            $account = User::where('email', $fbuser->getEmail())->first();
        }

        if ($account) {

            if($account->name != $fbuser->getName() && $fbuser->getName()){
                $account->name = $fbuser->getName();
                $account->save();
            }

            auth()->login($account);
            
            if(Session::get('backUrl') ){
                $returnUrl = Session::get('backUrl');
                Session::pull('backUrl');

                return redirect()->to($returnUrl);
            }else{
                return redirect()->to('/home');
            }
            

        } else {

            $account = new Social([
                'identifier' => $fbuser->getId(),
                'provider' => $service,
                'token' => $fbuser->token
            ]);

            $user = User::whereEmail($fbuser->getEmail())->first();

            if (!$user) {
                $time = Carbon::now()->timestamp;

                if ($fbuser->getEmail()) {
                    // check if partnership
                    if (filter_var($fbuser->getEmail(), FILTER_VALIDATE_EMAIL)) {
                        $list = list($user, $domain) = explode('@', $fbuser->getEmail());
                        $businessdomains =     Businessdomains::where('status', 1)->where('domainname', '=', $domain)->first();
                        if ($businessdomains) {
                            $businessdata = Businessdata::where('status', 1)->find($businessdomains->businessdata_id);
                            if ($businessdata) {
                                $businessdata_id = $businessdata->id;
                            }
                        }
                    }
                }

                $user = new User();
                //$user->name = $fbuser->getEmail() ? $fbuser->getEmail() : str_slug($fbuser->getName(), '-') . $time;
                $user->name = ($fbuser->getName()) ? $fbuser->getName() : $fbuser->getEmail();
                $user->email = $fbuser->getEmail() ? $fbuser->getEmail() : $service . rand(000, 999) . '@example.com';
                $user->first_name = json_encode([
                    'en' => (App::isLocale('en')) ? $fbuser->getName() : '',
                    'ar' => (App::isLocale('ar')) ? $fbuser->getName() : ''
                ], JSON_UNESCAPED_UNICODE);

                $user->password = bcrypt($fbuser->getId() . rand(000, 999));
                $user->group_id = env('DEFAULT_GROUP');
                $user->verified = env('DEFAULT_verified');
                $user->activated = env('DEFAULT_activated');
                $user->facebook_identifier = $fbuser->getId();
                // $user->image = saveImageAvatar(str_replace('http://','https://',$fbuser->getAvatar()));
                $user->businessdata_id = isset($businessdata_id) ? $businessdata_id : null;

                $userObject = new \stdClass;
                $userObject->name = $user->name;
                $userObject->email = $user->email;
                $userObject->password = $user->password;
                $userObject->group_id = env('DEFAULT_GROUP');
                $userObject->verified = env('DEFAULT_verified');
                $userObject->activated = env('DEFAULT_activated');
                $userObject->facebook_identifier = $user->facebook_identifier;
                $userObject->provider = $service;
                $userObject->token = $fbuser->token;
                $userObject->image = $user->image;
                $userObject->businessdata_id = $user->businessdata_id;

                Session::put('socialUserRegister', $userObject);
               // dd($userObject);
               // $user->save();
            }

            // $account->user()->associate($user);
            // $account->save();

            // auth()->login($user);

            if(Session::get('backUrl') ){
                $returnUrl = Session::get('backUrl');
                Session::pull('backUrl');

                return redirect()->to($returnUrl);
            }else{
                return redirect()->to('/home');
            }
        }
    }
}
