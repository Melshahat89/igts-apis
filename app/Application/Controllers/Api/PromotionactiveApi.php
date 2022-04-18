<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Promotionactive;
use App\Application\Transformers\PromotionactiveTransformers;
use App\Application\Requests\Website\Promotionactive\ApiAddRequestPromotionactive;
use App\Application\Requests\Website\Promotionactive\ApiUpdateRequestPromotionactive;

class PromotionactiveApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Promotionactive $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPromotionactive $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPromotionactive $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PromotionactiveTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PromotionactiveTransformers::transform($data) + $paginate), $status_code);
    }

}
