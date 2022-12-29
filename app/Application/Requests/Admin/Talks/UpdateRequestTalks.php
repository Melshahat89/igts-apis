<?php
 namespace App\Application\Requests\Admin\Talks;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestTalks extends FormRequest
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
        	"categories_id" => "required|integer",
            "title.*" => "",
   "slug" => "",
   "subtitle.*" => "",
   "description.*" => "",
   "language_id" => "",
   "length" => "",
   "featured" => "",
   "published" => "",
   "visits" => "",
   "video_file" => "",
   "sort" => "",
   "doctor_name.*" => "",
   "seo_desc.*.*" => "",
   "seo_keys.*.*" => "",
   "search_keys.*" => "",
   "image" => "",
   "promoPoster" => "",
   "cover" => "",
            ];
    }
}
