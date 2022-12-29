<?php
 namespace App\Application\Requests\Website\Quizquestions;
  class ApiAddRequestQuizquestions
{
    public function rules()
    {
        return [
        	"quiz_id" => "required|integer",
            "question" => "type",
   "mark" => "",
            ];
    }
}
