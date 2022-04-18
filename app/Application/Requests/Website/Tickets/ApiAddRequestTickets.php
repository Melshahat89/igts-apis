<?php
 namespace App\Application\Requests\Website\Tickets;
  class ApiAddRequestTickets
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
            "reciver_id" => "status",
   "priority" => "",
            ];
    }
}
