<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class SearchkeysTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"word" => $modelOrCollection->word,
			"ip" => $modelOrCollection->ip,
			"country" => $modelOrCollection->country,
			"city" => $modelOrCollection->city,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"word" => $modelOrCollection->word,
			"ip" => $modelOrCollection->ip,
			"country" => $modelOrCollection->country,
			"city" => $modelOrCollection->city,

        ];
    }

}