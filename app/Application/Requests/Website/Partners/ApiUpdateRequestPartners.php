<?php

namespace App\Application\Requests\Website\Partners;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestPartners
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "title" => "description.*",
			"search_keys.*" => "",
			
        ];
    }
}
