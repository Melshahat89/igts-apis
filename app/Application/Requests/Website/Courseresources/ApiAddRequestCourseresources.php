<?php
 namespace App\Application\Requests\Website\Courseresources;
  class ApiAddRequestCourseresources
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
            "title" => "",
   "file" => "",
            ];
    }
}
