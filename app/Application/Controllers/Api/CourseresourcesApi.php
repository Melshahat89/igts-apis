<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courseresources;
use App\Application\Transformers\CourseresourcesTransformers;
use App\Application\Requests\Website\Courseresources\ApiAddRequestCourseresources;
use App\Application\Requests\Website\Courseresources\ApiUpdateRequestCourseresources;

class CourseresourcesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courseresources $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourseresources $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourseresources $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CourseresourcesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CourseresourcesTransformers::transform($data) + $paginate), $status_code);
    }

}
