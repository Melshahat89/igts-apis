<?php
 namespace App\Application\Requests\Website\Talks;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestTalks
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"categories_id" => "required|integer",
            "title" => "slug",
   "cover" => "",
            ];
    }
}
