<?php

namespace App\Application\Requests\Website\Partners;


class ApiAddRequestPartners
{
    public function rules()
    {
        return [
            "title" => "description.*",
			"search_keys.*" => "",
			
        ];
    }
}
