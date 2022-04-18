<?php

namespace App\Application\Requests\Website\Faq;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestFaq
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "group_id" => "question.*",
			"answer" => "",
			
        ];
    }
}
