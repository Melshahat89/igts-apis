<?php
 namespace App\Application\Requests\Website\Talksrelated;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTalksrelated
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"talks_id" => "required|integer",
            "position" => "",
            ];
    }
}
