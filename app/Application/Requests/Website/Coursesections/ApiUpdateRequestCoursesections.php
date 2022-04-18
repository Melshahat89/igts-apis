<?php
 namespace App\Application\Requests\Website\Coursesections;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCoursesections
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
            "title" => "will|do|at|the|end.*",
   "position" => "",
            ];
    }
}
