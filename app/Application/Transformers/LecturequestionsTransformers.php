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
			"question_description" => $modelOrCollection->question_description,
			"approve" => $modelOrCollection->approve,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"question_title" => $modelOrCollection->question_title,
			"question_description" => $modelOrCollection->question_description,
			"approve" => $modelOrCollection->approve,

        ];
    }

}