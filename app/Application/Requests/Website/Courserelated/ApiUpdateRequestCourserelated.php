<?php
 namespace App\Application\Requests\Website\Courserelated;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourserelated
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
            "position" => "",
            ];
    }
}
