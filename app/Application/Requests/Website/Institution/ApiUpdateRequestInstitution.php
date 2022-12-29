<?php

namespace App\Application\Requests\Website\Institution;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestInstitution
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "temp1" => "",
			"temp2" => "",
			
        ];
    }
}
