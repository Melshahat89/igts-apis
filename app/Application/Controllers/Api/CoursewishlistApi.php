<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Coursewishlist;
use App\Application\Transformers\CoursewishlistTransformers;
use App\Application\Requests\Website\Coursewishlist\ApiAddRequestCoursewishlist;
use App\Application\Requests\Website\Coursewishlist\ApiUpdateRequestCoursewishlist;

class CoursewishlistApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Coursewishlist $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCoursewishlist $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCoursewishlist $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CoursewishlistTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CoursewishlistTransformers::transform($data) + $paginate), $status_code);
    }

}
