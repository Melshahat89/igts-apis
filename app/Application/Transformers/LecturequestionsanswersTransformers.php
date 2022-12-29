<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class LecturequestionsanswersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"answer" => $modelOrCollection->answer,
			"is_instructor" => $modelOrCollection->is_instructor,
			"user_id" => $modelOrCollection->user_id,
            "created_at" => $modelOrCollection->created_at,

        ];
    }

}