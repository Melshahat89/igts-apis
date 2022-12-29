<?php
 namespace App\Application\Requests\Admin\Courses;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestCourses extends FormRequest
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
        	"categories_id" => "required|integer",
            "title.*" => "",
   "slug" => "unique:courses",
   "description.*" => "",
   "welcome_message.*" => "",
   "congratulation_message.*" => "",
   "type" => "",
   "skill_level" => "",
   "language_id" => "",
   "has_captions" => "",
   "has_certificate" => "",
   "length" => "",
   "price" => "",
   "price_in_dollar" => "",
   "affiliate1_per" => "",
   "affiliate2_per" => "",
   "affiliate3_per" => "",
   "affiliate4_per" => "",
   "instructor_per" => "",
   "discount_egp" => "",
   "discount_usd" => "",
   "featured" => "",
   "image" => "",
   "promo_video" => "",
   "visits" => "",
   "published" => "",
   "position" => "",
   "sort" => "",
   "doctor_name.*" => "",
   "full_access" => "",
   "access_time" => "",
   "soon" => "",
   "seo_desc.*.*" => "",
   "seo_keys.*.*" => "",
   "search_keys.*.*" => "",
   "poster" => "",
            ];
    }
}
