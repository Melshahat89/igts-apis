<?php

namespace App\Application\Requests\Website\Categories;


class ApiAddRequestCategories
{
    public function rules()
    {
        return [
            "name" => "requiredslug",
			"image" => "image",
			
        ];
    }
}
