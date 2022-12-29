<?php

namespace App\Application\Requests\Website\Homesettings;


class ApiAddRequestHomesettings
{
    public function rules()
    {
        return [
            "bundles" => "featured|courses",
			"talks" => "",
			
        ];
    }
}
