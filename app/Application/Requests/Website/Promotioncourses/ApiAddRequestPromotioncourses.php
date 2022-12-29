<?php
 namespace App\Application\Requests\Website\Promotioncourses;
  class ApiAddRequestPromotioncourses
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
         "promotions_id" => "required|integer",
            "note" => "",
            ];
    }
}
