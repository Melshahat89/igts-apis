<?php

namespace App\Application\Requests\Website\Promotions;


class ApiAddRequestPromotions
{
    public function rules()
    {
        return [
            "title" => "description",
			"include_courses" => "",
			
        ];
    }
}
