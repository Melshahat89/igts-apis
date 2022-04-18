<?php
 namespace App\Application\Requests\Website\Lecturequestionsanswers;
  class ApiAddRequestLecturequestionsanswers
{
    public function rules()
    {
        return [
        	"lecturequestions_id" => "required|integer",
         "user_id" => "required|integer",
            "answer" => "",
            ];
    }
}
