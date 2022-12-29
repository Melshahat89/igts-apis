<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Promotions;
use App\Application\Transformers\PromotionsTransformers;
use App\Application\Requests\Website\Promotions\ApiAddRequestPromotions;
use App\Application\Requests\Website\Promotions\ApiUpdateRequestPromotions;

class PromotionsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Promotions $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPromotions $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPromotions $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PromotionsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PromotionsTransformers::transform($data) + $paginate), $status_code);
    }

}
