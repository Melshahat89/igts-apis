<?php
 namespace App\Application\Requests\Website\Businessdomains;
  class ApiAddRequestBusinessdomains
{
    public function rules()
    {
        return [
        	"businessdata_id" => "required|integer",
            "domainname" => "",
   "status" => "",
            ];
    }
}
