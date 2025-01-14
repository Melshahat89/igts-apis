<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PartnersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"description" => $modelOrCollection->description_lang,
			"logo" => 'https://igtsservice.com/uploads/files/medium/'.$modelOrCollection->logo,

        ];
    }

}