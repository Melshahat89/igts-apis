<?php
 namespace App\Application\Requests\Website\Courseincludes;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCourseincludes
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
