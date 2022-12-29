<?php

namespace App\Application\Requests\Website\Slider;


class ApiAddRequestSlider
{
    public function rules()
    {
        return [
            "title" => "description.*",
			"status" => "",
			
        ];
    }
}
