<?php
 namespace App\Application\Requests\Website\Promotioncourses;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestPromotioncourses
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "promotions_id" => "required|integer",
            "note" => "",
            ];
    }
}
