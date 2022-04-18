<?php

namespace App\Application\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateRequestSlider extends FormRequest
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
            "title.*" => "",
			"description.*" => "",
			"image_m_ar" => "",
			"image_m_en" => "",
			"image_d_ar" => "",
			"image_d_en" => "",
			"status" => "",
			
        ];
    }
}
