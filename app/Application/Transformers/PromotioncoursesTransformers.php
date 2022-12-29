<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PromotioncoursesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"note" => $modelOrCollection->note,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"note" => $modelOrCollection->note,

        ];
    }

}