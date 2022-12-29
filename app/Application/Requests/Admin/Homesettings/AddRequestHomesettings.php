<?php

namespace App\Application\Requests\Admin\Homesettings;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestHomesettings extends FormRequest
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
            "bundles" => "",
			"featured_courses" => "",
			"events" => "",
			"talks" => "",
			
        ];
    }
}
