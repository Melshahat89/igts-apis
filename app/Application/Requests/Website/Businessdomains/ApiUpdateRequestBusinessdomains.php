<?php
 namespace App\Application\Requests\Website\Businessdomains;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestBusinessdomains
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"businessdata_id" => "required|integer",
            "domainname" => "",
   "status" => "",
            ];
    }
}
