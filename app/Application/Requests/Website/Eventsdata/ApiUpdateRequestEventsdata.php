<?php
 namespace App\Application\Requests\Website\Eventsdata;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestEventsdata
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
            "name" => "email",
   "status" => "",
            ];
    }
}
