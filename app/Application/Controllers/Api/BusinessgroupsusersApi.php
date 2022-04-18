<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businessgroupsusers;
use App\Application\Transformers\BusinessgroupsusersTransformers;
use App\Application\Requests\Website\Businessgroupsusers\ApiAddRequestBusinessgroupsusers;
use App\Application\Requests\Website\Businessgroupsusers\ApiUpdateRequestBusinessgroupsusers;

class BusinessgroupsusersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Businessgroupsusers $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBusinessgroupsusers $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBusinessgroupsusers $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(BusinessgroupsusersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(BusinessgroupsusersTransformers::transform($data) + $paginate), $status_code);
    }

}
