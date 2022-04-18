<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class EventsreviewsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"review" => $modelOrCollection->review,
			"rating" => $modelOrCollection->rating,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"review" => $modelOrCollection->review,
			"rating" => $modelOrCollection->rating,

        ];
    }

}