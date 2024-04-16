<?php

namespace App\Application\Controllers\Api;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Controllers\Api\ApiTrait;
use App\Application\Controllers\Controller;
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
use App\Application\Transformers\CourseAnalysisTransformers;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Transformers\MyCoursesTransformers;
use App\Application\Transformers\QuizstudentsstatusTransformers;
use App\Application\Transformers\TransactionsTransformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;

use Illuminate\Support\Arr;

class AccountControllerApi extends Controller
{
    use ApiTrait;
    protected $userInterface;
    protected $request;
    protected $middleware;

    public function __construct(User $model, Request $request)
    {
        parent::__construct($model);
        $this->request = $request;
    }
    public function myLearning(){

        $now = date('Y-m-d');

        $data = Courseenrollment::where('user_id',Auth::guard('api')->user()->id)->whereDate('start_time', '<=', $now)
            ->whereDate('end_time', '>=', $now)
            ->where('status', 1);

        $data = $data->get();

        foreach($data as $course){
            foreach($course->courses->courseincludes as $courseincludes){
                foreach($data as $key => $course2){
                    if($courseincludes->includedCourse->id == $course2->courses->id){
                        unset($data[$key]);
                    }
                }
            }
        }

        if (request()->has("type") && request()->get("type") != "") {
            foreach($data as $key => $courses){
                if($courses->courses->type != request()->get("type")){
                    unset($data[$key]);
                }
            }
        }

        $data = initPaginate($data, 8);

        if ($data) {
            return response(apiReturn(['items' => array_values(MyCoursesTransformers::transform($data))] + $this->paginateArray($data)), 200);
//            return response(apiReturn(MyCoursesTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function myCertifications(){
        $data = Quizstudentsstatus::where('user_id',Auth::guard('api')->user()->id)->where('status',4)->where('passed',1)->get();
        if ($data) {
            return response(apiReturn(QuizstudentsstatusTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }
    public function myExams(){
        $data = Quizstudentsstatus::where('user_id',Auth::guard('api')->user()->id)->where('status',4)->get();
        if ($data) {
            return response(apiReturn(QuizstudentsstatusTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }
    public function settings(Request $request){

        $user = Auth::guard('api')->user();
        if(request()->has('password') && request()->post('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed|required_with:password_confirmation',
                'password_confirmation' => 'required',
                'old_password' => 'required',
            ]);

            if (!Hash::check( request()->post('old_password'),Auth::guard('api')->user()->password)) {
                return response(apiReturn(trans('website.The current password is incorrect'),'error', trans('website.The current password is incorrect') ), 401);
            }

            if ($validator->fails()) {
                return response(apiReturn(['error'=>$validator->errors()],'error', ['error'=>$validator->errors()] ), 401);
            }
            $user->password = bcrypt($request->password);
        }

        if(request()->has('name') && request()->post('name') != ''){
            $user->first_name = (json_encode([
                'en' => (request()->post('name')),
                'ar' => (request()->post('name'))
            ], JSON_UNESCAPED_UNICODE)) ;

            $user->name = request()->post('name');
        }

        if(request()->has('email') && request()->post('email') != ''){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255|unique:users',
            ]);
            if ($validator->fails()) {
                return response(apiReturn(['error'=>$validator->errors()],'error', ['error'=>$validator->errors()] ), 401);
            }
            $user->email = request()->post('email');
        }

        if(request()->has('mobile') && request()->post('mobile') != ''){
            $user->mobile = request()->post('mobile');
        }

        if(request()->hasfile('image') && request()->file('image') != ''){
            $file = request()->file('image');


//            $name= $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $name = rand(11111,99999).'_'.time().'.'.$extension;
            $file->move(env('SAVE_IMAGE').'/', $name);
            $user->image = $name;
        }
        if(request()->has('stop_account') && request()->post('stop_account') == 1){
            $user->verified = 0;
            $user->activated = 0;
        }
        if(request()->has('delete_account') && request()->post('delete_account') == 1){
            $user->verified = 0;
            $user->activated = 0;
        }
        $user->save();
        return response(apiReturn(trans('website.Your data has been successfully updated'), '', ''), 200);
    }

    public function getAllNotifications(){
        $userId = Auth::guard('api')->user()->id;
        $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/../../../../storage/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
            ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        $database = $factory->createDatabase();
        $reference = $database->getReference('notifications/'.$userId);
        $snapshot = $reference->getSnapshot();

        if($snapshot->hasChildren()){
            $data =  array_values($snapshot->getValue());
            foreach ($data as &$value) {
                $start_date = date('m-d-Y', $value['timestamp']);
                $value['timestamp'] = $start_date;
            }
            return response(apiReturn(['items'=>$data]), 200);
        }else{
            return response(apiReturn('', '', 'No Data Found'), 200);
        }

    }
    public function readAllNotifications(){
        $userId = Auth::guard('api')->user()->id;
        $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/../../../../public/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
            ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        $database = $factory->createDatabase();
        $reference = $database->getReference('notifications/'.$userId);
        $snapshot = $reference->orderByChild('is_read')
            // returns all persons being exactly 1.98 (meters) tall
            ->equalTo(0)
            ->getSnapshot();
        $update = ['is_read'  => 1 ];
        if ( count($snapshot->getValue()) > 0  ){
            foreach  ($reference->getChildKeys() as $noti){
                $reference = $database->getReference('notifications/'.$userId.'/'.$noti);
                $reference->update($update);
            }
        }
        return response(apiReturn(trans('website.Your data has been successfully updated'), '', ''), 200);
    }
    public function notificationsCount(){
        $userId = Auth::guard('api')->user()->id;
        $factory = (new Factory)
            ->withServiceAccount(__DIR__.'/../../../../public/igts-17eb7-firebase-adminsdk-xf52q-4331e0c95c.json')
            ->withDatabaseUri('https://igts-17eb7.firebaseio.com');
        $database = $factory->createDatabase();
        $reference = $database->getReference('notifications/'.$userId)

            ->orderByChild('is_read')
            // returns all persons being exactly 1.98 (meters) tall
            ->equalTo(0)
            ->getSnapshot();
        $data = $reference->getValue();
        return response(apiReturn(['count' => count($data)]), 200);
    }

    public function generalSettings(Request $request){
        return response(apiReturn(trans('website.Your data has been successfully updated'), '', ''), 200);
    }

    public function getGeneralSettings(){
        $data = [
            'learning_reminders' => '1',
            'download_wifi_only'=>'1',
            'download_to_sd'=>'1',
            'video_download_quality'=>'720',
            'notification_course_related'=>'1',
            'notification_learning_reminders'=>'1'
        ];
        return response(apiReturn($data, '', ''), 200);
    }

    public function recommendedTopics(Request $request){

        $validator = Validator::make($request->all(), [
            'Category' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $user = Auth::guard('api')->user();
        $user->categories = json_encode($request->Category);
        $user->save();

        return response(apiReturn(trans('website.Your data has been successfully updated'), '', ''), 200);

    }
    public function getRecommendedTopics(){
        $categories = json_decode(Auth::guard('api')->user()->categories);
        return response(apiReturn($categories, '', ''), 200);

    }
    public function instructorDashboard(Request $request){
        $user = Auth::guard('api')->user();
        if ($user->group_id != User::TYPE_INSTRUCTOR) {
            return response(apiReturn('', '', trans('website.You do not have permission')), 403);
        }
        $this->data['enrolledStudents'] = $user->EnrolledCountStudents;
        $this->data['totalRevenue'] =  $user->transactionsInstructorAll->sum('amount');
        $this->data['instructorCourses'] =  count($user->instructorCourses);
        $this->data['InstructorRating'] =  $user->InstructorRating;

//        $this->data['Affiliate1Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE1)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//        $this->data['Affiliate2Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE2)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//        $this->data['Affiliate3Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE3)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//        $this->data['Affiliate4Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE4)->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
        $this->data['myCourses'] = CourseAnalysisTransformers::transform(Courses::where('instructor_id',$user->id)->get()) ;
        $Transactions = Transactions::where('user_id', $user->id)->where('price', '>', 0)->where('amount', '>', 0)->get();
        $this->data['transactions'] = TransactionsTransformers::transform($Transactions);

        if($request->has('from') && $request->has('to')){
            $this->data['from'] = $from = $request->get('from');
            $this->data['to'] = $to = $request->get('to');
            $enrolledStudentsSum = 0;
            $instructorCourses = $user->instructorCourses;

            foreach($instructorCourses as $course){
                $enrolledStudentsSum += Transactions::where('courses_id', $course->id)->where('user_id', $user->id)->where('price', '>', 0)->whereBetween('date', [$from, $to])->count();
            }

            $this->data['enrolledStudents'] = $enrolledStudentsSum;
            $this->data['totalRevenue'] = $user->transactionsInstructorAll->filter(function($item) use($from, $to) {
                if($item->date >= $from && $item->date <= $to){
                    return $item;
                }
            })->sum('amount');
//            $this->data['Affiliate1Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE1)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//            $this->data['Affiliate2Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE2)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//            $this->data['Affiliate3Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE3)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();
//            $this->data['Affiliate4Courses']= Transactions::where('user_id',$user->id)->where('type',Transactions::AFFILIATE4)->whereBetween('date', [$from, $to])->selectRaw('sum(amount) sumAmount,courses_id')->groupBy('courses_id')->get();

        }
        return response(apiReturn($this->data, '', ''), 200);

    }





}
