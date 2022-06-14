<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Coursesections;
use App\Application\Transformers\CoursesectionsTransformers;
use App\Application\Requests\Website\Coursesections\ApiAddRequestCoursesections;
use App\Application\Requests\Website\Coursesections\ApiUpdateRequestCoursesections;

class CoursesectionsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Coursesections $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCoursesections $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCoursesections $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
        return response(apiReturn(CoursesectionsTransformers::transform($data) + $paginate), $status_code);
    }

}
