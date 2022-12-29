<?php

namespace App\Application\Requests\Website\Institution;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestInstitution extends FormRequest
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
            "temp1" => "",
			"temp2" => "",
			
        ];
    }
}
