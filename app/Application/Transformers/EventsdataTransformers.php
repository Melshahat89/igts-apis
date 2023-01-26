<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class EventsdataTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "en")},
			"email" => $modelOrCollection->email,
			"logo" => large($modelOrCollection->logo),
			"website" => $modelOrCollection->website,
			"about" => $modelOrCollection->{lang("about" , "en")},
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "ar")},
			"email" => $modelOrCollection->email,
			"logo" => $modelOrCollection->logo,
			"website" => $modelOrCollection->website,
			"about" => $modelOrCollection->{lang("about" , "ar")},
			"status" => $modelOrCollection->status,

        ];
    }

}