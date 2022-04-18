<?php
 namespace App\Application\Requests\Website\Transactions;
  class ApiAddRequestTransactions
{
    public function rules()
    {
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
