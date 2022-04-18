<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courses;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Requests\Website\Courses\ApiAddRequestCourses;
use App\Application\Requests\Website\Courses\ApiUpdateRequestCourses;

class CoursesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourses $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CoursesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CoursesTransformers::transform($data) + $paginate), $status_code);
    }

}
