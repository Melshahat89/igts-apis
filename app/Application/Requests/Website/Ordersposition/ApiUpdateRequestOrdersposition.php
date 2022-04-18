<?php
 namespace App\Application\Requests\Website\Ordersposition;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestOrdersposition
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"events_id" => "required|integer",
         "user_id" => "required|integer",
         "courses_id" => "required|integer",
         "orders_id" => "required|integer",
            "amount" => "notes",
   "status" => "",
            ];
    }
}
