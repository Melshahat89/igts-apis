<?php
 namespace App\Application\Requests\Website\Courses;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourses
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"categories_id" => "required|integer",
            "title" => "slug",
   "poster" => "",
            ];
    }
}
