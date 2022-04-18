<?php
 namespace App\Application\Requests\Website\Courseincludes;
  class ApiAddRequestCourseincludes
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
            "position" => "",
            ];
    }
}
