<?php
 namespace App\Application\Requests\Website\Promotionactive;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestPromotionactive
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "promotions_id" => "required|integer",
            "status" => "",
            ];
    }
}
