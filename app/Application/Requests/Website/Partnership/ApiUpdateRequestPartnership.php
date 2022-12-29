<?php

namespace App\Application\Requests\Website\Partnership;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestPartnership
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "setting" => "",
			
        ];
    }
}
