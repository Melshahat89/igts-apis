<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Promotioncourses;
use App\Application\Transformers\PromotioncoursesTransformers;
use App\Application\Requests\Website\Promotioncourses\ApiAddRequestPromotioncourses;
use App\Application\Requests\Website\Promotioncourses\ApiUpdateRequestPromotioncourses;

class PromotioncoursesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Promotioncourses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPromotioncourses $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPromotioncourses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PromotioncoursesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PromotioncoursesTransformers::transform($data) + $paginate), $status_code);
    }

}
