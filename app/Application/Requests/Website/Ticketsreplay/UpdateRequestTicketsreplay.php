<?php
 namespace App\Application\Requests\Website\Ticketsreplay;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestTicketsreplay extends FormRequest
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
        	"tickets_id" => "required|integer",
         "user_id" => "required|integer",
            "message" => "",
   "reciver_id" => "",
            ];
    }
}
