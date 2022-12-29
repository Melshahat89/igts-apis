<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursenotesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"notes" => $modelOrCollection->notes,
			"user_id" => $modelOrCollection->user_id,
        ];
    }


}