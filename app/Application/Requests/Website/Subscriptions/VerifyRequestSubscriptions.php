<?php
 namespace App\Application\Requests\Website\Subscriptions;
 use Illuminate\Foundation\Http\FormRequest;
 class VerifyRequestSubscriptions
{

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "receipt" => "required",
            ];
    }
}
