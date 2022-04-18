<?php
 namespace App\Application\Requests\Website\Promotionusers;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestPromotionusers
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"orders_id" => "required|integer",
         "user_id" => "required|integer",
         "promotions_id" => "required|integer",
            "used" => "",
            ];
    }
}
