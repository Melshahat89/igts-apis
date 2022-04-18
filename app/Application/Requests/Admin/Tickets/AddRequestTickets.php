<?php
 namespace App\Application\Requests\Admin\Tickets;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestTickets extends FormRequest
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
        	"user_id" => "required|integer",
            "reciver_id" => "",
   "status" => "",
   "type" => "",
   "title" => "",
   "message" => "",
   "priority" => "",
            ];
    }
}
