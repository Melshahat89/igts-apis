<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Ordersposition;
use App\Application\Transformers\OrderspositionTransformers;
use App\Application\Requests\Website\Ordersposition\ApiAddRequestOrdersposition;
use App\Application\Requests\Website\Ordersposition\ApiUpdateRequestOrdersposition;

class OrderspositionApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Ordersposition $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestOrdersposition $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestOrdersposition $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(OrderspositionTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(OrderspositionTransformers::transform($data) + $paginate), $status_code);
    }

}
