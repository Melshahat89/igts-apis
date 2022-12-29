<?php
 namespace App\Application\Requests\Website\Eventsreviews;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestEventsreviews
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"events_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
