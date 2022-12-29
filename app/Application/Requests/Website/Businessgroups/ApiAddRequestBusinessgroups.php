<?php
 namespace App\Application\Requests\Website\Businessgroups;
  class ApiAddRequestBusinessgroups
{
    public function rules()
    {
        return [
        	"businessdata_id" => "required|integer",
            "name" => "",
   "parent_id" => "",
            ];
    }
}
