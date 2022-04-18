<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TalksrelatedTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"position" => $modelOrCollection->position,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"position" => $modelOrCollection->position,

        ];
    }

}