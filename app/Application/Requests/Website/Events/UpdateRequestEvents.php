<?php
 namespace App\Application\Requests\Website\Events;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestEvents extends FormRequest
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
        	// "eventsdata_id" => "required|integer",
         "categories_id" => "required|integer",
            "title.*" => "required",
   "description.*" => "",
   "image" => "",
   "is_free" => "",
   "price_egp" => "",
   "price_usd" => "",
   "type" => "required",
   "status" => "",
   "location" => "",
   "live_link" => "",
   "recorded_link" => "",
            ];
    }
}
