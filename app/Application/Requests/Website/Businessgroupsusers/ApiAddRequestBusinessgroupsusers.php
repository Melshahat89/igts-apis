<?php
 namespace App\Application\Requests\Website\Businessgroupsusers;
  class ApiAddRequestBusinessgroupsusers
{
    public function rules()
    {
        return [
        	"user_id" => "required|integer",
         "businessgroups_id" => "required|integer",
            "status" => "",
   "note" => "",
            ];
    }
}
