<?php
 namespace App\Application\Requests\Website\Searchkeys;
  class ApiAddRequestSearchkeys
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
            "word" => "ip",
   "city" => "",
            ];
    }
}
