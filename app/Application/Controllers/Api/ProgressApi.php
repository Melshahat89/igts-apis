<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Progress;
use App\Application\Transformers\ProgressTransformers;
use App\Application\Requests\Website\Progress\ApiAddRequestProgress;
use App\Application\Requests\Website\Progress\ApiUpdateRequestProgress;

class ProgressApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Progress $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestProgress $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestProgress $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(ProgressTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(ProgressTransformers::transform($data) + $paginate), $status_code);
    }

}
