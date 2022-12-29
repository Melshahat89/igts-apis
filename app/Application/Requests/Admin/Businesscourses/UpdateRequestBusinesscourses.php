<?php
 namespace App\Application\Requests\Admin\Businesscourses;
 use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
 class UpdateRequestBusinesscourses extends FormRequest
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
        	"courses_id" => "required|integer",
         "businessdata_id" => "required|integer",
            "comment" => "",
   "status" => "",
            ];
    }
}
