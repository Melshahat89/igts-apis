<?php
 namespace App\Application\Requests\Website\Transactions;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestTransactions extends FormRequest
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
         "courses_id" => "required|integer",
         "payments_id" => "required|integer",
         "user_id" => "required|integer",
            "price" => "",
   "currency" => "",
   "percent" => "",
   "amount" => "",
   "type" => "",
   "date" => "",
            ];
    }
}
