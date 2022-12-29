<?php

namespace App\Application\Requests\Website\Testimonials;


class ApiAddRequestTestimonials
{
    public function rules()
    {
        return [
            "name" => "title.*",
			"image" => "",
			
        ];
    }
}
