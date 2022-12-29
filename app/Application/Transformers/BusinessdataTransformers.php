<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class BusinessdataTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "en")},
			"discount_type" => $modelOrCollection->discount_type,
			"discount_value" => $modelOrCollection->discount_value,
			"automatically_license" => $modelOrCollection->automatically_license,
			"logo" => $modelOrCollection->logo,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "ar")},
			"discount_type" => $modelOrCollection->discount_type,
			"discount_value" => $modelOrCollection->discount_value,
			"automatically_license" => $modelOrCollection->automatically_license,
			"logo" => $modelOrCollection->logo,
			"status" => $modelOrCollection->status,

        ];
    }

}