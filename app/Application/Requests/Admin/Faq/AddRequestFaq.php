<?php

namespace App\Application\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestFaq extends FormRequest
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
            "group_id" => "",
			"question.*" => "",
			"answer.*" => "",
			
        ];
    }
}
