<?php
 namespace App\Application\Requests\Website\Eventstickets;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestEventstickets
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "events_id" => "required|integer",
         "eventsdata_id" => "required|integer",
            "name" => "email",
   "code" => "",
            ];
    }
}
