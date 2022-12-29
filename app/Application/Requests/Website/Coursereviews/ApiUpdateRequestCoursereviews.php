<?php
 namespace App\Application\Requests\Website\Coursereviews;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCoursereviews
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "rating",
   "manual_image" => "",
            ];
    }
}
