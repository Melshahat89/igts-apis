<?php
 namespace App\Application\Requests\Website\Businesscourses;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestBusinesscourses
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "businessdata_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
