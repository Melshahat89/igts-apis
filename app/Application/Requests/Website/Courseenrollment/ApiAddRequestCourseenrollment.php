<?php
 namespace App\Application\Requests\Website\Courseenrollment;
  class ApiAddRequestCourseenrollment
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "start_time" => "end|time",
   "status" => "",
            ];
    }
}
