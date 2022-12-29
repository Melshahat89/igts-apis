<?php

namespace App\Application\Requests\Website\Promotions;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestPromotions
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "title" => "description",
			"include_courses" => "",
			
        ];
    }
}
