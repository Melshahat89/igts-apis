<?php

namespace App\Application\Requests\Website\Categories;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestCategories extends FormRequest
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
            "name.*" => "required",
			"slug" => "",
			"desc.*" => "",
			"parent_id" => "",
			"sort" => "integer",
			"status" => "",
			"show_home" => "",
			"show_menu" => "",
			"m_image" => "image",
			"d_image" => "image",
			"image" => "image",
			
        ];
    }
}
