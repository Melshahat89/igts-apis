<?php
 namespace App\Application\Requests\Website\Courserelated;
  class ApiAddRequestCourserelated
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
            "position" => "",
            ];
    }
}
