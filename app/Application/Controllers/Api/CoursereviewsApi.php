<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Coursereviews;
use App\Application\Transformers\CoursereviewsTransformers;
use App\Application\Requests\Website\Coursereviews\ApiAddRequestCoursereviews;
use App\Application\Requests\Website\Coursereviews\ApiUpdateRequestCoursereviews;

class CoursereviewsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Coursereviews $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCoursereviews $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCoursereviews $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(array_values(CoursereviewsTransformers::transformAr($data) + $paginate)), $status_code);
        }
        return response(apiReturn(array_values(CoursereviewsTransformers::transform($data) + $paginate)), $status_code);
    }

}
