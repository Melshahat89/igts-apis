<?php
 namespace App\Application\Requests\Admin\Masterrequest;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestMasterrequest extends FormRequest
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
        	"courses_id" => "required|integer",
         "user_id" => "required|integer",
            "qualification" => "",
   "collage_name" => "",
   "section" => "",
   "g_year" => "",
   "address" => "",
   "documentation.*" => "",
            ];
    }
}
