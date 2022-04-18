<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizquestionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"question" => $modelOrCollection->{lang("question" , "en")},
			"type" => $modelOrCollection->type,
			"mark" => $modelOrCollection->mark,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"question" => $modelOrCollection->{lang("question" , "ar")},
			"type" => $modelOrCollection->type,
			"mark" => $modelOrCollection->mark,

        ];
    }

}