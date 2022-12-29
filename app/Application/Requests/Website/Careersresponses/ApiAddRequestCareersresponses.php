<?php
 namespace App\Application\Requests\Website\Careersresponses;
  class ApiAddRequestCareersresponses
{
    public function rules()
    {
        return [
        	"careers_id" => "required|integer",
            "name" => "email",
   "file" => "",
            ];
    }
}
