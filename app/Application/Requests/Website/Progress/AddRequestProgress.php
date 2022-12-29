<?php
 namespace App\Application\Requests\Website\Progress;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestProgress extends FormRequest
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
         "courses_id" => "required|integer",
         "user_id" => "required|integer",
            "percentage" => "",
   "note" => "",
            ];
    }
}
