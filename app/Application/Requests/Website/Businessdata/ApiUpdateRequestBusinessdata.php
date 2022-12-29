<?php
 namespace App\Application\Requests\Website\Businessdata;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestBusinessdata
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
            "name" => "discount|type",
   "status" => "",
            ];
    }
}
