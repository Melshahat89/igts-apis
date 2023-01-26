<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TestimonialsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "en")},
			"title" => $modelOrCollection->{lang("title" , "en")},
			"message" => $modelOrCollection->{lang("message" , "en")},
			"image" => large($modelOrCollection->image),

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "ar")},
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"message" => $modelOrCollection->{lang("message" , "ar")},
			"image" => $modelOrCollection->image,

        ];
    }

}