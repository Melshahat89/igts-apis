<?php
 namespace App\Application\Requests\Website\Quiz;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestQuiz
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"coursesections_id" => "required|integer",
         "courses_id" => "required|integer",
            "title" => "description.*",
   "pass_percentage" => "",
            ];
    }
}
