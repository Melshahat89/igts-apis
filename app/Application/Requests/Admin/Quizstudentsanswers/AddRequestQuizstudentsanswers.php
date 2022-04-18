<?php
 namespace App\Application\Requests\Admin\Quizstudentsanswers;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestQuizstudentsanswers extends FormRequest
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
        	"quizstudentsstatus_id" => "required|integer",
         "quiz_id" => "required|integer",
         "quizquestions_id" => "required|integer",
         "quizquestionschoice_id" => "required|integer",
         "user_id" => "required|integer",
            "is_correct" => "",
   "answered" => "",
   "mark" => "",
            ];
    }
}
