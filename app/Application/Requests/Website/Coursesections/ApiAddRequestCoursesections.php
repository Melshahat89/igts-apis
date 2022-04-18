<?php
 namespace App\Application\Requests\Website\Coursesections;
  class ApiAddRequestCoursesections
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
            "title" => "will|do|at|the|end.*",
   "position" => "",
            ];
    }
}
