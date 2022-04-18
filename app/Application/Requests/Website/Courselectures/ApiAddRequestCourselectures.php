<?php
 namespace App\Application\Requests\Website\Courselectures;
  class ApiAddRequestCourselectures
{
    public function rules()
    {
        return [
        	"coursesections_id" => "required|integer",
         "user_id" => "required|integer",
         "courses_id" => "required|integer",
            "title" => "slug",
   "position" => "",
            ];
    }
}
