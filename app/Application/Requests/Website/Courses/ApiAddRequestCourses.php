<?php
 namespace App\Application\Requests\Website\Courses;
  class ApiAddRequestCourses
{
    public function rules()
    {
        return [
        	"categories_id" => "required|integer",
            "title" => "slug",
   "poster" => "",
            ];
    }
}
