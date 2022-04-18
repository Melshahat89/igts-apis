<?php

namespace App\Application\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateRequestCategories extends FormRequest
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
        $rules = [
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

        if($this->has('enable_free') && $this->get('enable_free') == 1){
            $rules["courses_id"] = "required|numeric";
            $rules["end_time"] = "required";
        }

        return $rules;
    }
}
