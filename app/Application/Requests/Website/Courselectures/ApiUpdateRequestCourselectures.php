<?php
 namespace App\Application\Requests\Website\Courselectures;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourselectures
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"coursesections_id" => "required|integer",
         "user_id" => "required|integer",
         "courses_id" => "required|integer",
            "title" => "slug",
   "position" => "",
            ];
    }
}
