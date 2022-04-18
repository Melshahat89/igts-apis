<?php
 namespace App\Application\Requests\Website\Lecturequestionsanswers;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestLecturequestionsanswers
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"lecturequestions_id" => "required|integer",
         "user_id" => "required|integer",
            "answer" => "",
            ];
    }
}
