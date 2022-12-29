<?php
 namespace App\Application\Requests\Website\Businessdata;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestBusinessdata extends FormRequest
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
            "name.*" => "",
   "discount_type" => "",
   "discount_value" => "",
   "automatically_license" => "",
   "logo" => "",
   "status" => "",
            ];
    }
}
