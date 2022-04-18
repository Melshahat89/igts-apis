<?php
 namespace App\Application\Requests\Website\Searchkeys;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestSearchkeys
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
            "word" => "ip",
   "city" => "",
            ];
    }
}
