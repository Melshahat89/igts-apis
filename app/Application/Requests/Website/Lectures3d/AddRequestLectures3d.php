<?php
 namespace App\Application\Requests\Website\Lectures3d;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestLectures3d extends FormRequest
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
            "title" => "",
   "link" => "",
            ];
    }
}
