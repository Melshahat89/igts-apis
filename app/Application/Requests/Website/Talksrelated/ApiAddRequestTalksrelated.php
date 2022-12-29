<?php
 namespace App\Application\Requests\Website\Talksrelated;
  class ApiAddRequestTalksrelated
{
    public function rules()
    {
        return [
        	"talks_id" => "required|integer",
            "position" => "",
            ];
    }
}
