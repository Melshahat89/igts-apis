<?php

namespace App\Application\Transformers;

use App\Application\Model\Coursereviews;
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
			"manual_name" => (($modelOrCollection->type == Coursereviews::TYPE_DYNAMIC) && isset($modelOrCollection->user)) ? $modelOrCollection->user['name']:large($modelOrCollection->manual_name),
			"manual_image" => (($modelOrCollection->type == Coursereviews::TYPE_DYNAMIC) && isset($modelOrCollection->user)) ? $modelOrCollection->user['image']:large($modelOrCollection->manual_image),

        ];
    }


}