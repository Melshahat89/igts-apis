<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Ticketsreplay;
use App\Application\Transformers\TicketsreplayTransformers;
use App\Application\Requests\Website\Ticketsreplay\ApiAddRequestTicketsreplay;
use App\Application\Requests\Website\Ticketsreplay\ApiUpdateRequestTicketsreplay;

class TicketsreplayApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Ticketsreplay $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTicketsreplay $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTicketsreplay $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TicketsreplayTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TicketsreplayTransformers::transform($data) + $paginate), $status_code);
    }

}
