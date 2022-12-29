<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PromotionactiveTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,

        ];
    }

}