<?php
 namespace App\Application\Requests\Website\Events;
  class ApiAddRequestEvents
{
    public function rules()
    {
        return [
        	"eventsdata_id" => "required|integer",
         "categories_id" => "required|integer",
            "title" => "description.*",
   "recorded_link" => "",
            ];
    }
}
