<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businessinputfields;
use App\Application\Model\Businessinputfieldsresponses;
use App\Application\Model\Categories;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Coursewishlist;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Model\Talks;
use App\Application\Model\Transactions;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\UserInterface;
use App\Application\Requests\Admin\User\UpdateRequestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\URL;

class AccountController extends AbstractController
{
	protected $userInterface;
    protected $middleware;

     public function __construct(User $model, UserInterface $userInterface)
     {
        parent::__construct($model);
        $this->userInterface = $userInterface;
     }

     public function edit(){


        $user = User::findOrFail(Auth::user()->id);
		$this->data['item'] =$this->model->findOrFail(Auth::user()->id);
        $this->data['socialConnectRow'] = isset($user->social) ? true : false;
        $this->data['categories'] = Categories::all()->pluck('name_lang', 'id')->toArray();

        $now = date('Y-m-d');
        $this->data['myCourses'] = Courseenrollment::where('user_id',Auth::user()->id)->whereDate('start_time', '<=', $now)
        ->whereDate('end_time', '>=', $now)
        ->where('status', 1)->get();

        return view('website.account.edit', $this->data);	

	 }
     public function analysis(Request $request){

		$this->data['model'] =$this->model->findOrFail(Auth::user()->id);
        // Affiliate 1 In Courses
        $this->data['Affiliate1Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE1)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
        // Affiliate 2 In Courses
        $this->data['Affiliate2Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE2)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
        // Affiliate 3 In Courses
        $this->data['Affiliate3Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE3)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
        // Affiliate 4 In Courses
        $this->data['Affiliate4Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE4)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
        $this->data['myCourses'] = Courses::where('instructor_id',Auth::user()->id)->get();
        $this->data['transactions'] = Transactions::where('user_id', Auth::user()->id)->where('price', '>', 0)->where('amount', '>', 0)->get();
        $this->data['enrolledStudents'] = $this->data['model']->EnrolledCountStudents;
        $this->data['totalRevenue'] =  $this->data['model']->transactionsInstructorAll->sum('amount');

        if($request->has('from') && $request->has('to')){
            $this->data['from'] = $from = $request->get('from');
            $this->data['to'] = $to = $request->get('to');
            $enrolledStudentsSum = 0;
            $instructorCourses = $this->data['model']->instructorCourses;

            foreach($instructorCourses as $course){
                $enrolledStudentsSum += Transactions::where('courses_id', $course->id)->where('user_id', Auth::user()->id)->where('price', '>', 0)->whereBetween('date', [$from, $to])->count();
            }

            $this->data['enrolledStudents'] = $enrolledStudentsSum;
            $this->data['totalRevenue'] = $this->data['model']->transactionsInstructorAll->filter(function($item) use($from, $to) {
                if($item->date >= $from && $item->date <= $to){
                    return $item;
                }
            })->sum('amount');
            $this->data['Affiliate1Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE1)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
            $this->data['Affiliate2Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE2)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
            $this->data['Affiliate3Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE3)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
            $this->data['Affiliate4Courses']= Transactions::where('user_id',Auth::user()->id)->where('type',Transactions::AFFILIATE4)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();

        }

        return view('website.account.analysis', $this->data);	

     }
     public function myCourses(){

        $now = date('Y-m-d');
        // $this->data['myCourses'] = Courseenrollment::where('user_id',Auth::user()->id)->whereDate('start_time', '<=', $now)
        // ->whereDate('end_time', '>=', $now)
        // ->where('status', 1)->get();
        $this->data['myCourses'] = initPaginate(hideIncludedCourses(), 10);

        return view('website.account.myCourses', $this->data);	

	 }
     public function myCertificates(){

        $this->data['certificates'] = initPaginate(Quizstudentsstatus::where('user_id',Auth::user()->id)->where('status',4)->whereNotNull('certificate')->get(), 10);
        $this->data['eventCertificates'] = Eventsenrollment::where('user_id', Auth::user()->id)->whereNotNull('certificate')->get();

        return view('website.account.myCertificates', $this->data);	

	 }
     public function myFavourites(){

        $this->data['myFavourites'] = initPaginate(Coursewishlist::where('user_id',Auth::user()->id)->get(), 10);
        return view('website.account.myFavourites', $this->data);	

     }
     
     public function complete(){

        Session::put('backUrl', URL::previous());

        $this->data['businessInputFields'] = Businessinputfields::where('businessdata_id', Auth::user()->businessdata_id)->get();
        $this->data['item'] =$this->model->findOrFail(Auth::user()->id);
        $this->data['categories'] = Categories::all()->pluck('name_lang', 'id')->toArray();
        return view('website.account.complete', $this->data);	

     }
      
     public function otp(){
        if(request()->has('otp') && request()->post('otp') != ''){
            
            if(request()->post('otp') == Auth::user()->otp){
                $value = request()->post('otp');
                $minutes = 129600;
                Cookie::queue('MeduoCookie', $value, $minutes);
                return redirect('/');
            }
            
            

        }
        $this->data['item'] =$this->model->findOrFail(Auth::user()->id);
        return view('website.account.otp', $this->data);	
     }

     public function sendOtp(){

        Auth::user()->OtpMail;
        alert()->success(trans('website.We sent you an Otp code. Check your email and click on the link to verify.'), trans('website.Success'));
        return redirect()->back();	
     }

     public function clearAllFavourites(){
         
        $this->data['myFavourites'] = Coursewishlist::where('user_id',Auth::user()->id)->delete();
        // alert()->error(trans('website.The current password is incorrect') , trans('website.Error Message'));
        return redirect()->back();

	 }
	 
	 public function update($id , UpdateRequestUser $request){

        // dd( Auth::user()->usersCoursesEnrollments);
        if($id != Auth::user()->id){
            abort('404');
        }
        $request->request->add(['usersCoursesEnrollments' => Auth::user()->usersCoursesEnrollments]);
        
        if(request()->has('password') && request()->post('password') != ''){
            $this->validate($request, [
                'password' => 'required|min:6|confirmed|required_with:password_confirmation',
                'password_confirmation' => 'required',
                'old_password' => 'required',
            ]);
            

            if (!Hash::check( request()->post('old_password'),Auth::user()->password)) {
                alert()->error(trans('website.The current password is incorrect') , trans('website.Error Message'));
                return redirect()->back();
               }
        }

        if(request()->has('first_name') && request()->post('first_name') != ''){
            $request->request->add(['first_name'=>json_encode([
                'en' => (request()->post('first_name')),
                'ar' => (request()->post('first_name'))
            ], JSON_UNESCAPED_UNICODE)]) ;
        }

        if(request()->has('last_name') && request()->post('last_name') != ''){
            $request->request->add(['last_name'=>json_encode([
                'en' => (request()->post('last_name')),
                'ar' => (request()->post('last_name'))
            ], JSON_UNESCAPED_UNICODE)]) ;
        }


        $request->request->add(['usersCoursesEnrollments'=> Auth::user()->usersCoursesEnrollments]) ;

        $request = $this->userInterface->checkRequest($request);

        $userObj = User::findOrFail($id);

     //   $item = app('App\Application\Controllers\Website\Business')->storeOrUpdate($request, null, true);


    //     foreach($request->all() as $key => $value) {

    //         if($key != "_token" && $key != "usersCoursesEnrollments") {
    //         if(strpos($key, 'business-') !== false) {
                

    //             $fieldName = substr($key, strpos($key, '-') + 1);
    //             $inputField = Businessinputfields::where('field_name', $fieldName)->get();
    //             $response = Businessinputfieldsresponses::where('businessinputfields_id', $inputField[0]->id)->get();
    //             if(count($response) == 0){
                    
    //                 $response = new Businessinputfieldsresponses;
    //                 $response->businessinputfields_id = $inputField[0]->id;
    //                 $response->user_id = $userObj->id;
    //                 $response->answer = $value;
    //                 $response->save();
    //             }else{
    //                 $response->answer = $value;
    //                 $response->save();
    //             }            

    //         }else{

    //             $userObj->$key = $value;
    //             $userObj->save();
    //         }
    //     }
    // }

        

        $User = $this->storeOrUpdate($request , $id , 'admin/user');
        alert()->success(trans('website.Your data has been successfully updated') , trans('website.Success'));

        if(Session::get('backUrl')){
            return redirect()->to(Session::get('backUrl'));

        }else{
            return redirect()->back();

        }


        //return $this->storeOrUpdate($request , $id , 'admin/user');
    }

    public function delete($id){

        $user = User::findOrFail($id);
        $user->courseenrollment()->delete();
        $user->orders()->delete();
        $user->ordersposition()->delete();
        $user->promotionusers()->delete();
        $user->promotionactive()->delete();
        $user->payments()->delete();
        $user->eventsenrollment()->delete();
        $user->eventstickets()->delete();
        $user->eventsreviews()->delete();
        $user->talksreviews()->delete();
        $user->coursereviews()->delete();

        $user->delete();


        alert()->info(trans('account.Delete Success'));

        return redirect()->to('/');

    }

}
