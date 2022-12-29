<?php
 namespace App\Application\Requests\Website\Quizstudentsstatus;
  class ApiAddRequestQuizstudentsstatus
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "quiz_id" => "required|integer",
            "start_time" => "end|time",
   "exam_anytime" => "",
            ];
    }
}
