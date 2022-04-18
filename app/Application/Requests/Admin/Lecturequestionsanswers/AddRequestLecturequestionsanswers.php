<?php
 namespace App\Application\Requests\Admin\Lecturequestionsanswers;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestLecturequestionsanswers extends FormRequest
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
        	"lecturequestions_id" => "required|integer",
         "user_id" => "required|integer",
            "answer" => "",
            ];
    }
}
