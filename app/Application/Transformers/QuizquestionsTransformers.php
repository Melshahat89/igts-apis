<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizquestionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"question" => $modelOrCollection->question_lang,
			"type" => $modelOrCollection->type,
			"mark" => $modelOrCollection->mark,
			"choice" => $modelOrCollection->quizquestionschoice ? QuizquestionschoiceTransformers::transform($modelOrCollection['quizquestionschoice']) : null,

        ];
    }


}