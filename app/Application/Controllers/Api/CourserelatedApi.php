<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courserelated;
use App\Application\Transformers\CourserelatedTransformers;
use App\Application\Requests\Website\Courserelated\ApiAddRequestCourserelated;
use App\Application\Requests\Website\Courserelated\ApiUpdateRequestCourserelated;

class CourserelatedApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courserelated $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourserelated $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourserelated $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CourserelatedTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CourserelatedTransformers::transform($data) + $paginate), $status_code);
    }

}
