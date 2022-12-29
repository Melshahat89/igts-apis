<?php
 namespace App\Application\Requests\Website\Quizquestionschoice;
  class ApiAddRequestQuizquestionschoice
{
    public function rules()
    {
        return [
        	"quizquestions_id" => "required|integer",
            "choice" => "",
   "is_correct" => "",
            ];
    }
}
