<?php
 namespace App\Application\Requests\Website\Careersresponses;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestCareersresponses
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"careers_id" => "required|integer",
            "name" => "email",
   "file" => "",
            ];
    }
}
