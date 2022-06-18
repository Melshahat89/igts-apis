<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"description" => htmlspecialchars(trim(strip_tags($modelOrCollection->description_lang))),
			"instructions" => $modelOrCollection->instructions,
			"time" => $modelOrCollection->time,
			"time_in_mins" => $modelOrCollection->time_in_mins,
			"type" => $modelOrCollection->type,
			"pass_percentage" => $modelOrCollection->pass_percentage,
            "questions" => $modelOrCollection->quizquestions ? QuizquestionsTransformers::transform($modelOrCollection['quizquestions']) : null,
        ];
    }


}