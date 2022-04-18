<?php

namespace App\Application\Requests\Website\PageRate;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestPageRate extends FormRequest
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
            "user_id" => "",
			"page_id" => "",
			"rate" => "min:1|max:5|required|integer",
			
        ];
    }
}
