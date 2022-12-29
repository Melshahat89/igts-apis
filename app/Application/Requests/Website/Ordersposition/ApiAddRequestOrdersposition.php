<?php
 namespace App\Application\Requests\Website\Ordersposition;
  class ApiAddRequestOrdersposition
{
    public function rules()
    {
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
