<?php
 namespace App\Application\Requests\Website\Progress;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestProgress
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courselectures_id" => "required|integer",
         "courses_id" => "required|integer",
         "user_id" => "required|integer",
            "percentage" => "",
   "note" => "",
            ];
    }
}
