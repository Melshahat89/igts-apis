<?php
 namespace App\Application\Requests\Website\Coursesections;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestCoursesections extends FormRequest
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
        	"courses_id" => "",
            "title.*" => "required",
   "will_do_at_the_end.*" => "",
   "position" => "",
            ];
    }
}
