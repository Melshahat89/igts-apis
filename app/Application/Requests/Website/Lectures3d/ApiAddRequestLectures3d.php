<?php
 namespace App\Application\Requests\Website\Lectures3d;
  class ApiAddRequestLectures3d
{
    public function rules()
    {
        return [
        	"courselectures_id" => "required|integer",
            "title" => "",
   "link" => "",
            ];
    }
}
