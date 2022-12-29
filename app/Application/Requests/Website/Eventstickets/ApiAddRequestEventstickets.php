<?php
 namespace App\Application\Requests\Website\Eventstickets;
  class ApiAddRequestEventstickets
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "events_id" => "required|integer",
         "eventsdata_id" => "required|integer",
            "name" => "email",
   "code" => "",
            ];
    }
}
