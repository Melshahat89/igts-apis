<?php
 namespace App\Application\Requests\Website\Transactions;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTransactions
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"events_id" => "required|integer",
         "courses_id" => "required|integer",
         "payments_id" => "required|integer",
         "user_id" => "required|integer",
            "price" => "currency",
   "date" => "",
            ];
    }
}
