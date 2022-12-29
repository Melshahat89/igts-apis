<?php
 namespace App\Application\Requests\Admin\Courseincludes;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestCourseincludes extends FormRequest
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
        	"courses_id" => "required|integer",
            "included_course" => 'required|integer',
            "position" => "",
            "included_course_title" => "",
            ];
    }
}
