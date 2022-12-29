<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Transactions;
use App\Application\Transformers\TransactionsTransformers;
use App\Application\Requests\Website\Transactions\ApiAddRequestTransactions;
use App\Application\Requests\Website\Transactions\ApiUpdateRequestTransactions;

class TransactionsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Transactions $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTransactions $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTransactions $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TransactionsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TransactionsTransformers::transform($data) + $paginate), $status_code);
    }

}
