<?php
 namespace App\Application\Requests\Website\Businesscourses;
  class ApiAddRequestBusinesscourses
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
         "businessdata_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
