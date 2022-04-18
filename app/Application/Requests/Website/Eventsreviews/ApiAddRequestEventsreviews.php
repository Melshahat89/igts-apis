<?php
 namespace App\Application\Requests\Website\Eventsreviews;
  class ApiAddRequestEventsreviews
{
    public function rules()
    {
        return [
        	"events_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
