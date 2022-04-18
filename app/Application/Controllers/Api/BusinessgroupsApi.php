<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businessgroups;
use App\Application\Transformers\BusinessgroupsTransformers;
use App\Application\Requests\Website\Businessgroups\ApiAddRequestBusinessgroups;
use App\Application\Requests\Website\Businessgroups\ApiUpdateRequestBusinessgroups;

class BusinessgroupsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Businessgroups $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBusinessgroups $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBusinessgroups $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(BusinessgroupsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(BusinessgroupsTransformers::transform($data) + $paginate), $status_code);
    }

}
