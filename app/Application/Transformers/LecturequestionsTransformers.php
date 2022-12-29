<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class LecturequestionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"question_title" => $modelOrCollection->question_title,
			"approve" => $modelOrCollection->approve,
			"user_id" => $modelOrCollection->user_id,
			"answers" => LecturequestionsanswersTransformers::transform($modelOrCollection->lecturequestionsanswers),
			"created_at" => $modelOrCollection->created_at,

        ];
    }

}