<?php
 namespace App\Application\Requests\Admin\Events;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestEvents extends FormRequest
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
        	"eventsdata_id" => "required|integer",
         "categories_id" => "required|integer",
            "title.*" => "",
   "description.*" => "",
   "image" => "",
   "is_free" => "",
   "price_egp" => "",
   "price_usd" => "",
   "type" => "",
   "status" => "",
   "location" => "",
   "live_link" => "",
   "recorded_link" => "",
            ];
    }
}
