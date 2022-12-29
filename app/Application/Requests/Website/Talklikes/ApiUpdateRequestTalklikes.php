<?php
 namespace App\Application\Requests\Website\Talklikes;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTalklikes
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "talks_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
