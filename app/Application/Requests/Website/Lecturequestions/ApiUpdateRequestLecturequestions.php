<?php
 namespace App\Application\Requests\Website\Lecturequestions;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestLecturequestions
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courselectures_id" => "required|integer",
         "user_id" => "required|integer",
            "question_title" => "question|description",
   "approve" => "",
            ];
    }
}
