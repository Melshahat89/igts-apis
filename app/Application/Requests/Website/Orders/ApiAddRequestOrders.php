<?php
 namespace App\Application\Requests\Website\Orders;
  class ApiAddRequestOrders
{
    public function rules()
    {
        return [
        	"payments_id" => "required|integer",
         "user_id" => "required|integer",
            "status" => "comments",
   "kiosk_id" => "",
            ];
    }
}
