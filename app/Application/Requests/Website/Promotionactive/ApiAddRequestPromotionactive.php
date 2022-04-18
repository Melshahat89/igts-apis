<?php
 namespace App\Application\Requests\Website\Promotionactive;
  class ApiAddRequestPromotionactive
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "promotions_id" => "required|integer",
            "status" => "",
            ];
    }
}
