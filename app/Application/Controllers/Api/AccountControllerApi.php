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
use App\Application\Transformers\CoursesTransformers;
use App\Application\Transformers\MyCoursesTransformers;
use App\Application\Transformers\QuizstudentsstatusTransformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\URL;

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

        if (request()->has("type") && request()->get("type") != "") {
            $data = $data->whereHas('courses', function($q){
                $q->where("type", "=", request()->get("type"));
            });
        }

        $data = $data->get();

        if ($data) {
            return response(apiReturn(MyCoursesTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function myCertifications(){
        $data = Quizstudentsstatus::where('user_id',Auth::guard('api')->user()->id)->where('status',4)->whereNotNull('certificate')->get();
        if ($data) {
            return response(apiReturn(QuizstudentsstatusTransformers::transform($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }




}
