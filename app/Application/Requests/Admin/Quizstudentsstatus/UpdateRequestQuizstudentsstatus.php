<?php
 namespace App\Application\Requests\Admin\Quizstudentsstatus;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestQuizstudentsstatus extends FormRequest
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
        	"user_id" => "required|integer",
         "quiz_id" => "required|integer",
            "start_time" => "",
   "end_time" => "",
   "pause_time" => "",
   "status" => "",
   "skipped_question_id" => "",
   "passed" => "",
   "exam_anytime" => "",
            ];
    }
}
