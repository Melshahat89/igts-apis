<?php
 namespace App\Application\Requests\Website\Eventsenrollment;
  class ApiAddRequestEventsenrollment
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "events_id" => "required|integer",
            "start_time" => "end|time",
   "status" => "",
            ];
    }
}
