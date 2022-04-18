<?php
 namespace App\Application\Requests\Admin\Talklikes;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestTalklikes extends FormRequest
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
        	"user_id" => "required|integer",
         "talks_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
