<?php
 namespace App\Application\Requests\Admin\Eventsenrollment;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestEventsenrollment extends FormRequest
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
        	"user_id" => "required|integer",
         "events_id" => "required|integer",
            "start_time" => "",
   "end_time" => "",
   "status" => "",
            ];
    }
}
