<?php
namespace App\Application\Requests\Website\Coursereviews;
class ApiAddRequestCoursereviews
{
    public function rules()
    {
        return [
            "courses_id" => "required|integer",
            "user_id" => "required|integer",
            "review" => "rating",
            "manual_image" => "",
        ];
    }
}
