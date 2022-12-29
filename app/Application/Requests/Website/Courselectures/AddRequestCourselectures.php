<?php
 namespace App\Application\Requests\Website\Courselectures;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestCourselectures extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        	"coursesections_id" => "required|integer",
        //  "user_id" => "required|integer",
        //  "courses_id" => "required|integer",
            "title.*" => "required",
   "slug" => "",
   "description.*" => "",
   "video_file" => "",
   "length" => "",
   "is_free" => "",
   "position" => "",
            ];
    }
}
