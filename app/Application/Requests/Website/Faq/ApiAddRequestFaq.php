<?php

namespace App\Application\Requests\Website\Faq;


class ApiAddRequestFaq
{
    public function rules()
    {
        return [
            "group_id" => "question.*",
			"answer" => "",
			
        ];
    }
}
