<?php
 namespace App\Application\Requests\Website\Talklikes;
  class ApiAddRequestTalklikes
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "talks_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
