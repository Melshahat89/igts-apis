<?php
 namespace App\Application\Requests\Admin\Payments;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestPayments extends FormRequest
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
        	"orders_id" => "required|integer",
         "user_id" => "required|integer",
            "operation" => "",
   "amount" => "",
   "currency_id" => "",
   "receiver_id" => "",
   "token" => "",
   "token_date" => "",
   "status" => "",
   "accept_source_data_type" => "",
   "accept_id" => "",
   "accept_pending" => "",
   "accept_order" => "",
   "accept_amount_cents" => "",
   "accept_success" => "",
   "accept_data_message" => "",
   "accept_profile_id" => "",
   "accept_source_data_sub_type" => "",
   "accept_hmac" => "",
   "txn_response_code" => "",
            ];
    }
}
