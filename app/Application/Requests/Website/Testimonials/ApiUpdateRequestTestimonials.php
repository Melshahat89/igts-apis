<?php

namespace App\Application\Requests\Website\Testimonials;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestTestimonials
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "name" => "title.*",
			"image" => "",
			
        ];
    }
}
