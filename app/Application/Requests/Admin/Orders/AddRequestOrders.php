<?php
 namespace App\Application\Requests\Admin\Orders;
 use Illuminate\Foundation\Http\FormRequest;
 class AddRequestOrders extends FormRequest
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
        $rules = ["user_id" => "required|integer", "grand-total" => "required|numeric", "currency" => "required"];

        if($this->has('certificates')){
            $rules["certificates-cost"] = "required|numeric";
        }

        if($this->has('courses')){
            $rules["coursesCost.*"] = "required|numeric";
        }

        if($this->has('coursesCost.*') && !$this->has('courses')){
            $rules["courses"] = "required";
        }

        if($this->has('certificates-cost') && !$this->has('certificates')){
            $rules["certificates"] = "required";
        }

        return $rules;
    }
}
