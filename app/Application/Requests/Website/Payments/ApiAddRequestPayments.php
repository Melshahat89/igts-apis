<?php
 namespace App\Application\Requests\Website\Payments;
  class ApiAddRequestPayments
{
    public function rules()
    {
        return [
        	"orders_id" => "required|integer",
         "user_id" => "required|integer",
            "operation" => "amount",
   "txn_response_code" => "",
            ];
    }
}
