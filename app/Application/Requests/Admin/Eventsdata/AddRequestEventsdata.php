<?php
 namespace App\Application\Requests\Admin\Eventsdata;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestEventsdata extends FormRequest
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
        	// "user_id" => "",
            "name.*" => "",
   "email" => "",
   "logo" => "",
   "website" => "",
   "about.*" => "",
   "status" => "",
            ];
    }
}
