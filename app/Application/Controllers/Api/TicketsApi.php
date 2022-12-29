<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Tickets;
use App\Application\Transformers\TicketsTransformers;
use App\Application\Requests\Website\Tickets\ApiAddRequestTickets;
use App\Application\Requests\Website\Tickets\ApiUpdateRequestTickets;

class TicketsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Tickets $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTickets $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTickets $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TicketsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TicketsTransformers::transform($data) + $paginate), $status_code);
    }

}
