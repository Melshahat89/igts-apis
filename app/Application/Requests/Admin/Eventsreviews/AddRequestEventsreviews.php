<?php
 namespace App\Application\Requests\Admin\Eventsreviews;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestEventsreviews extends FormRequest
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
        	"events_id" => "required|integer",
         "user_id" => "required|integer",
            "review" => "",
   "rating" => "",
            ];
    }
}
