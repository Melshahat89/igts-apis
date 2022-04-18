<?php
 namespace App\Application\Requests\Website\Quiz;
  class ApiAddRequestQuiz
{
    public function rules()
    {
        return [
        	"coursesections_id" => "required|integer",
         "courses_id" => "required|integer",
            "title" => "description.*",
   "pass_percentage" => "",
            ];
    }
}
