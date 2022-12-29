<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Lectures3d;
use App\Application\Transformers\Lectures3dTransformers;
use App\Application\Requests\Website\Lectures3d\ApiAddRequestLectures3d;
use App\Application\Requests\Website\Lectures3d\ApiUpdateRequestLectures3d;

class Lectures3dApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Lectures3d $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestLectures3d $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestLectures3d $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(Lectures3dTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(Lectures3dTransformers::transform($data) + $paginate), $status_code);
    }

}
