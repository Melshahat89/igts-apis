<?php

namespace App\Application\Requests\Website\Social;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestSocial
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "user_id" => "provider",
			"session_data" => "",
			
        ];
    }
}
