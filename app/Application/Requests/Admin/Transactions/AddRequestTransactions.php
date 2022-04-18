<?php
 namespace App\Application\Requests\Admin\Transactions;
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
        	"events_id" => "",
         "courses_id" => "",
         "payments_id" => "",
         "user_id" => "",
            "price" => "",
   "currency" => "",
   "percent" => "",
   "amount" => "",
   "type" => "",
   "date" => "",
            ];
    }
}
