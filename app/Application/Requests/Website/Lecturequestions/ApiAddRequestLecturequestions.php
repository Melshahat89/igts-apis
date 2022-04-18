<?php
 namespace App\Application\Requests\Website\Lecturequestions;
  class ApiAddRequestLecturequestions
{
    public function rules()
    {
        return [
        	"courselectures_id" => "required|integer",
         "user_id" => "required|integer",
            "question_title" => "question|description",
   "approve" => "",
            ];
    }
}
