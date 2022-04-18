<?php
 namespace App\Application\Requests\Admin\Ordersposition;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestOrdersposition extends FormRequest
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
        	"events_id" => "required|integer",
         "user_id" => "required|integer",
         "courses_id" => "required|integer",
         "orders_id" => "required|integer",
            "amount" => "",
   "notes" => "",
   "certificate_id" => "",
   "shipping_id" => "",
   "status" => "",
            ];
    }
}
