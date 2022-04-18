<?php
 namespace App\Application\Requests\Website\Talksreviews;
  class ApiAddRequestTalksreviews
{
    public function rules()
    {
        return [
        	"talks_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
