<?php
 namespace App\Application\Requests\Website\Lectures3d;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestLectures3d
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courselectures_id" => "required|integer",
            "title" => "",
   "link" => "",
            ];
    }
}
