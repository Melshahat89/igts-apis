<?php
 namespace App\Application\Requests\Website\Progress;
  class ApiAddRequestProgress
{
    public function rules()
    {
        return [
        	"courselectures_id" => "required|integer",
         "courses_id" => "required|integer",
         "user_id" => "required|integer",
            "percentage" => "",
   "note" => "",
            ];
    }
}
