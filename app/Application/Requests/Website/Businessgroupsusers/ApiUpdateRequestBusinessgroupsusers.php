<?php
 namespace App\Application\Requests\Website\Businessgroupsusers;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestBusinessgroupsusers
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"user_id" => "required|integer",
         "businessgroups_id" => "required|integer",
            "status" => "",
   "note" => "",
            ];
    }
}
