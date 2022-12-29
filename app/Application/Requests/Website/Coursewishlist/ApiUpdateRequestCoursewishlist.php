<?php
 namespace App\Application\Requests\Website\Coursewishlist;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCoursewishlist
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "note" => "",
            ];
    }
}
