<?php

namespace App\Application\Requests\Website\Careers;


class ApiAddRequestCareers
{
    public function rules()
    {
        return [
            "title" => "description.*",
			"image" => "",
			
        ];
    }
}
