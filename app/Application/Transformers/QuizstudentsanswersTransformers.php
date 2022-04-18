<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizstudentsanswersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"is_correct" => $modelOrCollection->is_correct,
			"answered" => $modelOrCollection->answered,
			"mark" => $modelOrCollection->mark,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"is_correct" => $modelOrCollection->is_correct,
			"answered" => $modelOrCollection->answered,
			"mark" => $modelOrCollection->mark,

        ];
    }

}