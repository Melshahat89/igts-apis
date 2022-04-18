<?php
 namespace App\Application\Requests\Website\Businessgroups;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestBusinessgroups
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"businessdata_id" => "required|integer",
            "name" => "",
   "parent_id" => "",
            ];
    }
}
