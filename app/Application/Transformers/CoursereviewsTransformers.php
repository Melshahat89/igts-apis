<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursereviewsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"review" => $modelOrCollection->review,
			"rating" => $modelOrCollection->rating,
			"type" => $modelOrCollection->type,
			"manual_name" => $modelOrCollection->manual_name,
			"manual_image" => $modelOrCollection->manual_image,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"review" => $modelOrCollection->review,
			"rating" => $modelOrCollection->rating,
			"type" => $modelOrCollection->type,
			"manual_name" => $modelOrCollection->manual_name,
			"manual_image" => $modelOrCollection->manual_image,

        ];
    }

}