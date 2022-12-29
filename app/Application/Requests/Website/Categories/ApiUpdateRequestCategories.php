<?php

namespace App\Application\Requests\Website\Categories;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestCategories
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "name" => "requiredslug",
			"image" => "image",
			
        ];
    }
}
