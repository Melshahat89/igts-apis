<?php
 namespace App\Application\Requests\Website\Tickets;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTickets
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
            "reciver_id" => "status",
   "priority" => "",
            ];
    }
}
