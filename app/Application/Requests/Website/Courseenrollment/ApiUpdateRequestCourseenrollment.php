<?php
 namespace App\Application\Requests\Website\Courseenrollment;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourseenrollment
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "start_time" => "end|time",
   "status" => "",
            ];
    }
}
