<?php
 namespace App\Application\Requests\Website\Ticketsreplay;
  class ApiAddRequestTicketsreplay
{
    public function rules()
    {
        return [
        	"tickets_id" => "required|integer",
         "user_id" => "required|integer",
            "message" => "",
   "reciver_id" => "",
            ];
    }
}
