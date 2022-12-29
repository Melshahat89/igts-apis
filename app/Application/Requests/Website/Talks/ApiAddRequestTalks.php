<?php
 namespace App\Application\Requests\Website\Talks;
  class ApiAddRequestTalks
{
    public function rules()
    {
        return [
        	"categories_id" => "required|integer",
            "title" => "slug",
   "cover" => "",
            ];
    }
}
