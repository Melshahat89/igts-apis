<?php
 namespace App\Application\Requests\Admin\Lecturequestions;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestLecturequestions extends FormRequest
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
        	"courselectures_id" => "required|integer",
         "user_id" => "required|integer",
            "question_title" => "",
   "question_description" => "",
   "approve" => "",
            ];
    }
}
