<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Partnership;
use App\Application\Transformers\PartnershipTransformers;
use App\Application\Requests\Website\Partnership\ApiAddRequestPartnership;
use App\Application\Requests\Website\Partnership\ApiUpdateRequestPartnership;

class PartnershipApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Partnership $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPartnership $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPartnership $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PartnershipTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PartnershipTransformers::transform($data) + $paginate), $status_code);
    }

}
