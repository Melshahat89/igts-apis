<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courselectures;
use App\Application\Transformers\CourselecturesTransformers;
use App\Application\Requests\Website\Courselectures\ApiAddRequestCourselectures;
use App\Application\Requests\Website\Courselectures\ApiUpdateRequestCourselectures;

class CourselecturesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courselectures $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourselectures $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourselectures $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CourselecturesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CourselecturesTransformers::transform($data) + $paginate), $status_code);
    }

}
