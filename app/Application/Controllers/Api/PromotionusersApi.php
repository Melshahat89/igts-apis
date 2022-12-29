<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Promotionusers;
use App\Application\Transformers\PromotionusersTransformers;
use App\Application\Requests\Website\Promotionusers\ApiAddRequestPromotionusers;
use App\Application\Requests\Website\Promotionusers\ApiUpdateRequestPromotionusers;

class PromotionusersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Promotionusers $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPromotionusers $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPromotionusers $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PromotionusersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PromotionusersTransformers::transform($data) + $paginate), $status_code);
    }

}
