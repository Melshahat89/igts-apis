<?php
 namespace App\Application\Requests\Website\Businessdata;
  class ApiAddRequestBusinessdata
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
            "name" => "discount|type",
   "status" => "",
            ];
    }
}
