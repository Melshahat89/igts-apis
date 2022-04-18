<?php
 namespace App\Application\Requests\Website\Talksreviews;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTalksreviews
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"talks_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
