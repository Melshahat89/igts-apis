<?php
 namespace App\Application\Requests\Admin\Careersresponses;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestCareersresponses extends FormRequest
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
        	"careers_id" => "required|integer",
            "name" => "",
   "email" => "",
   "mobile" => "",
   "file" => "",
            ];
    }
}
