<?php
 namespace App\Application\Requests\Website\Orders;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestOrders extends FormRequest
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
        	"payments_id" => "required|integer",
         "user_id" => "required|integer",
            "status" => "",
   "comments" => "",
   "billing_address_id" => "",
   "accept_order_id" => "",
   "kiosk_id" => "",
            ];
    }
}
