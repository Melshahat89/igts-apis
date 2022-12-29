<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businessdomains;
use App\Application\Transformers\BusinessdomainsTransformers;
use App\Application\Requests\Website\Businessdomains\ApiAddRequestBusinessdomains;
use App\Application\Requests\Website\Businessdomains\ApiUpdateRequestBusinessdomains;

class BusinessdomainsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Businessdomains $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBusinessdomains $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBusinessdomains $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(BusinessdomainsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(BusinessdomainsTransformers::transform($data) + $paginate), $status_code);
    }

}
