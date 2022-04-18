<?php
 namespace App\Application\Requests\Website\Masterrequest;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestMasterrequest
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "qualification" => "collage|name",
   "documentation.*" => "",
            ];
    }
}
