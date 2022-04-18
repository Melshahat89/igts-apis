<?php
 namespace App\Application\Requests\Website\Eventsenrollment;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestEventsenrollment
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "events_id" => "required|integer",
            "start_time" => "end|time",
   "status" => "",
            ];
    }
}
