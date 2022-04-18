<?php
 namespace App\Application\Requests\Website\Courseincludes;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestCourseincludes extends FormRequest
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
        	"courses_id" => "required|integer",
            "position" => "",
            ];
    }
}
