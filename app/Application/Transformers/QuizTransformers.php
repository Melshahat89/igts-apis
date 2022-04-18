<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"instructions" => $modelOrCollection->instructions,
			"time" => $modelOrCollection->time,
			"time_in_mins" => $modelOrCollection->time_in_mins,
			"type" => $modelOrCollection->type,
			"pass_percentage" => $modelOrCollection->pass_percentage,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"instructions" => $modelOrCollection->instructions,
			"time" => $modelOrCollection->time,
			"time_in_mins" => $modelOrCollection->time_in_mins,
			"type" => $modelOrCollection->type,
			"pass_percentage" => $modelOrCollection->pass_percentage,

        ];
    }

}