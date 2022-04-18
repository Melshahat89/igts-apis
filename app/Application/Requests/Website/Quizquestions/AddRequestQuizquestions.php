<?php
 namespace App\Application\Requests\Website\Quizquestions;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestQuizquestions extends FormRequest
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
        	// "quiz_id" => "required|integer",
            "question.*" => "required",
   "type" => "",
   "mark" => "",
            ];
    }
}
