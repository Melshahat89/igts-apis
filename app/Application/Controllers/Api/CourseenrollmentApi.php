<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courseenrollment;
use App\Application\Transformers\CourseenrollmentTransformers;
use App\Application\Requests\Website\Courseenrollment\ApiAddRequestCourseenrollment;
use App\Application\Requests\Website\Courseenrollment\ApiUpdateRequestCourseenrollment;

class CourseenrollmentApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courseenrollment $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourseenrollment $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourseenrollment $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CourseenrollmentTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CourseenrollmentTransformers::transform($data) + $paginate), $status_code);
    }

}
