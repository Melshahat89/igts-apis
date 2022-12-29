<?php
 namespace App\Application\Requests\Website\Courselectures;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestCourselectures extends FormRequest
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
        $id = Route::input('id');
        return [
        	// "coursesections_id" => "required|integer",
        //  "user_id" => "required|integer",
        //  "courses_id" => "required|integer",
            "title.*" => "",
   "slug" => "",
   "description.*" => "",
   "video_file" => "",
   "length" => "",
   "is_free" => "",
   "position" => "",
            ];
    }
}
