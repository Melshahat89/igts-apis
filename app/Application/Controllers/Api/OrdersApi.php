<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Orders;
use App\Application\Transformers\OrdersTransformers;
use App\Application\Requests\Website\Orders\ApiAddRequestOrders;
use App\Application\Requests\Website\Orders\ApiUpdateRequestOrders;

class OrdersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Orders $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestOrders $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestOrders $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(OrdersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(OrdersTransformers::transform($data) + $paginate), $status_code);
    }

}
