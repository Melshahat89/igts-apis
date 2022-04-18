<?php
 namespace App\Application\Requests\Website\Promotionusers;
  class ApiAddRequestPromotionusers
{
    public function rules()
    {
        return [
        	"orders_id" => "required|integer",
         "user_id" => "required|integer",
         "promotions_id" => "required|integer",
            "used" => "",
            ];
    }
}
