<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Institution;
use App\Application\Transformers\InstitutionTransformers;
use App\Application\Requests\Website\Institution\ApiAddRequestInstitution;
use App\Application\Requests\Website\Institution\ApiUpdateRequestInstitution;

class InstitutionApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Institution $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestInstitution $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestInstitution $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(InstitutionTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(InstitutionTransformers::transform($data) + $paginate), $status_code);
    }

}
