<?php
 namespace App\Application\Requests\Website\Ticketsreplay;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTicketsreplay
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"tickets_id" => "required|integer",
         "user_id" => "required|integer",
            "message" => "",
   "reciver_id" => "",
            ];
    }
}
