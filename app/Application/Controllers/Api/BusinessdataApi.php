<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businessdata;
use App\Application\Transformers\BusinessdataTransformers;
use App\Application\Requests\Website\Businessdata\ApiAddRequestBusinessdata;
use App\Application\Requests\Website\Businessdata\ApiUpdateRequestBusinessdata;

class BusinessdataApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Businessdata $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBusinessdata $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBusinessdata $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(BusinessdataTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(BusinessdataTransformers::transform($data) + $paginate), $status_code);
    }

}
