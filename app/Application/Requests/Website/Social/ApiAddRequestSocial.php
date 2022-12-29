<?php

namespace App\Application\Requests\Website\Social;


class ApiAddRequestSocial
{
    public function rules()
    {
        return [
            "user_id" => "provider",
			"session_data" => "",
			
        ];
    }
}
