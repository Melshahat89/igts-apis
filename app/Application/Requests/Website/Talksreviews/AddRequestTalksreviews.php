<?php
 namespace App\Application\Requests\Website\Talksreviews;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestTalksreviews extends FormRequest
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
        	"talks_id" => "required|integer",
        //  "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
