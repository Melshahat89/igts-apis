<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Partners;
use App\Application\Transformers\PartnersTransformers;
use App\Application\Requests\Website\Partners\ApiAddRequestPartners;
use App\Application\Requests\Website\Partners\ApiUpdateRequestPartners;

class PartnersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Partners $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPartners $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPartners $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PartnersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PartnersTransformers::transform($data) + $paginate), $status_code);
    }

}
