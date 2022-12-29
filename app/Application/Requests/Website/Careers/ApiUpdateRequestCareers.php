<?php

namespace App\Application\Requests\Website\Careers;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestCareers
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "title" => "description.*",
			"image" => "",
			
        ];
    }
}
