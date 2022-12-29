<?php
 namespace App\Application\Requests\Website\Payments;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestPayments
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"orders_id" => "required|integer",
         "user_id" => "required|integer",
            "operation" => "amount",
   "txn_response_code" => "",
            ];
    }
}
