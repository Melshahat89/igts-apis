<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizquestionschoiceTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"choice" => $modelOrCollection->{lang("choice" , "en")},
			"is_correct" => $modelOrCollection->is_correct,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"choice" => $modelOrCollection->{lang("choice" , "ar")},
			"is_correct" => $modelOrCollection->is_correct,

        ];
    }

}