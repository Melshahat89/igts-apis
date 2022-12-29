<?php
 namespace App\Application\Requests\Website\Events;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestEvents
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"eventsdata_id" => "required|integer",
         "categories_id" => "required|integer",
            "title" => "description.*",
   "recorded_link" => "",
            ];
    }
}
