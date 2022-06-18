<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizquestionschoiceTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"choice" => $modelOrCollection->choice_lang,
			"is_correct" => $modelOrCollection->is_correct,

        ];
    }


}