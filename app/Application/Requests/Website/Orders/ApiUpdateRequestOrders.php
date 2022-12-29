<?php
 namespace App\Application\Requests\Website\Orders;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestOrders
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"payments_id" => "required|integer",
         "user_id" => "required|integer",
            "status" => "comments",
   "kiosk_id" => "",
            ];
    }
}
