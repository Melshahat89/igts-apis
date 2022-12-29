<?php
 namespace App\Application\Requests\Website\Quizstudentsanswers;
  class ApiAddRequestQuizstudentsanswers
{
    public function rules()
    {
        return [
        	"quizstudentsstatus_id" => "required|integer",
         "quiz_id" => "required|integer",
         "quizquestions_id" => "required|integer",
         "quizquestionschoice_id" => "required|integer",
         "user_id" => "required|integer",
            "is_correct" => "answered",
   "mark" => "",
            ];
    }
}
