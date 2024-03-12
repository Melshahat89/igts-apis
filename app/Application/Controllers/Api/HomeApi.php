<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\BecomeInstructor;
use App\Application\Model\Contact;
use App\Application\Model\Homesettings;
use App\Application\Model\Partners;
use App\Application\Model\Payments;
use App\Application\Transformers\HomesettingsTransformers;
use App\Application\Requests\Website\Homesettings\ApiAddRequestHomesettings;
use App\Application\Requests\Website\Homesettings\ApiUpdateRequestHomesettings;
use App\Application\Transformers\PartnersTransformers;
use App\Application\Transformers\QuizstudentsstatusTransformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Homesettings $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestHomesettings $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestHomesettings $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(HomesettingsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(HomesettingsTransformers::transform($data) + $paginate), $status_code);
    }

    public function countersHome(){
        return response(apiReturn([
            'Students' => 1000,
            'Courses' => 500,
            'Hours' => 20000,
            'Comments' => 1200,
        ]), 200);
    }
    public function topSearches(){
        return response(apiReturn([
                'ادارة',
                'تمريض',
                'الطوارئ',
                'تغذية',
                'الصحه النفسيه',
                'التسويق',
                'الارشاد',
        ]), 200);
    }
    public function quickLinks(){
        return response(apiReturn([
                [
                    'name' => 'Become',
                    'title' => 'an instructor',
                    'link' => 'https://igtsservice.com/joinAsInstructor',
                    'image' => 'https://igtsservice.com/website/images/joininstructor3.jpg',
                ],
                [
                    'name' => 'ًWork',
                    'title' => 'with us',
                    'link' => 'https://igtsservice.com/en/careers',
                    'image' => 'https://igtsservice.com/uploads/files/medium/41556_1651057576.jpg',
                ],
                [
                    'name' => 'Our',
                    'title' => 'partners',
                    'link' => 'https://igtsservice.com/en/partners',
                    'image' => 'https://igtsservice.com/uploads/files/medium/67995_1649936390.jpg',
                ],

        ]), 200);
    }


    public function contactUs(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|max:1000',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()],'error', ['error'=>$validator->errors()] ), 401);
        }

        $user = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        if($user){
            return response(apiReturn(trans('website.Your message has Been sent')), 200);
        }
    }

    public function partners(){
        $data = Partners::get();
        if ($data) {
            return response(apiReturn(PartnersTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function test(Request $request){

        dd(auth()->guard('api')->user());
//       dd(342);
    }

    public function checkoutApi(Request $request){

        $user = Auth::guard('api')->user();

//        dd($user);
        Auth::guard()->login($user);


//        if (Auth::guard($user)->check()) {
//         dd(22);
//        }

//        if(function_exists('shell_exec')) {
//            echo "shell_exec is enabled";
//        } else {
//            echo "shell_exec is disabled";
//        }
//        dd(Auth::user());
//
//
//        dd(Session::get('variableName'));

        $request->headers->set('Authorization', `Bearer $request->cookie('accessToken')`);

        return response(apiReturn(['url'=>'https://igtsservice.com/cart'], '', ''), 200);

//        return redirect('site/payments');
    }


    public function subscriptions(){

        $homeSettings = Homesettings::where('id', 1)->first();
        $this->data['subscription_monthly'] = round($homeSettings->MonthlyB2cSubscriptionPrice);
        $this->data['subscription_yearly_after'] = round($homeSettings->YearlyB2cSubscriptionPrice);
        $this->data['subscription_yearly_before'] = round(($homeSettings->MonthlyB2cSubscriptionPrice * 12));
        $this->data['currency'] = getCurrency();
        $this->data['link'] = 'https://igtsservice.com/ar/subscriptions#pricing';


        return response(apiReturn([$this->data]), 200);
    }

}
