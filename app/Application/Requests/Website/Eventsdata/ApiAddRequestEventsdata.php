<?php
 namespace App\Application\Requests\Website\Eventsdata;
  class ApiAddRequestEventsdata
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
            "name" => "email",
   "status" => "",
            ];
    }
}
