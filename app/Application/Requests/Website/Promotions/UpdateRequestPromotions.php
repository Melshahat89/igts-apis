<?php

namespace App\Application\Requests\Website\Promotions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateRequestPromotions extends FormRequest
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
            "title" => "",
			"description" => "",
			"type" => "",
			"value_for_egp" => "",
			"value_for_other_currencies" => "",
			"code" => "",
			"start_date" => "",
			"expiration_date" => "",
			"active" => "",
			"promotion_limit" => "",
			"promotion_usage" => "",
			"publish_as_notification" => "",
			"notification_message" => "",
			"include_courses" => "",
			
        ];
    }
}
