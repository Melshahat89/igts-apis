<?php
 namespace App\Application\Requests\Website\Masterrequest;
  class ApiAddRequestMasterrequest
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "qualification" => "collage|name",
   "documentation.*" => "",
            ];
    }
}
