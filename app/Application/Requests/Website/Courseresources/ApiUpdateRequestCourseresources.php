<?php
 namespace App\Application\Requests\Website\Courseresources;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourseresources
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
            "title" => "",
   "file" => "",
            ];
    }
}
