<?php
 namespace App\Application\Requests\Website\Quiz;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestQuiz extends FormRequest
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
        	"coursesections_id" => "required|integer",
         "courses_id" => "required|integer",
            "title.*" => "",
   "description.*" => "",
   "instructions" => "",
   "time" => "",
   "time_in_mins" => "",
   "type" => "",
   "pass_percentage" => "",
            ];
    }
}
