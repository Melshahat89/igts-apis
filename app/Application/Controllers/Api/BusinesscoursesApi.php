<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businesscourses;
use App\Application\Transformers\BusinesscoursesTransformers;
use App\Application\Requests\Website\Businesscourses\ApiAddRequestBusinesscourses;
use App\Application\Requests\Website\Businesscourses\ApiUpdateRequestBusinesscourses;

class BusinesscoursesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Businesscourses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBusinesscourses $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBusinesscourses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(BusinesscoursesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(BusinesscoursesTransformers::transform($data) + $paginate), $status_code);
    }

}
