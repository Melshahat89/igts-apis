<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courseincludes;
use App\Application\Transformers\CourseincludesTransformers;
use App\Application\Requests\Website\Courseincludes\ApiAddRequestCourseincludes;
use App\Application\Requests\Website\Courseincludes\ApiUpdateRequestCourseincludes;

class CourseincludesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courseincludes $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourseincludes $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourseincludes $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CourseincludesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CourseincludesTransformers::transform($data) + $paginate), $status_code);
    }

}
