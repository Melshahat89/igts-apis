<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PromotionusersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"used" => $modelOrCollection->used,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"used" => $modelOrCollection->used,

        ];
    }

}