<?php
 namespace App\Application\Requests\Website\Coursewishlist;
  class ApiAddRequestCoursewishlist
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "note" => "",
            ];
    }
}
