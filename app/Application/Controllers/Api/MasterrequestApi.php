<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Masterrequest;
use App\Application\Transformers\MasterrequestTransformers;
use App\Application\Requests\Website\Masterrequest\ApiAddRequestMasterrequest;
use App\Application\Requests\Website\Masterrequest\ApiUpdateRequestMasterrequest;

class MasterrequestApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Masterrequest $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestMasterrequest $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestMasterrequest $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(MasterrequestTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(MasterrequestTransformers::transform($data) + $paginate), $status_code);
    }

}
