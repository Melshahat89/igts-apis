<?php

namespace App\Application\Requests\Website\Homesettings;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestHomesettings
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "bundles" => "featured|courses",
			"talks" => "",
			
        ];
    }
}
