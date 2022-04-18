<?php
 namespace App\Application\Requests\Website\Quizstudentsstatus;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestQuizstudentsstatus
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "quiz_id" => "required|integer",
            "start_time" => "end|time",
   "exam_anytime" => "",
            ];
    }
}
