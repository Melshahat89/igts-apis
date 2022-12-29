<?php

namespace App\Application\Requests\Website\BecomeInstructor;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestBecomeInstructor
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "name" => "email",
			"socialAccount" => "",
			
        ];
    }
}
