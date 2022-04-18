<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class FaqTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"group_id" => $modelOrCollection->group_id,
			"question" => $modelOrCollection->{lang("question" , "en")},
			"answer" => $modelOrCollection->{lang("answer" , "en")},

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"group_id" => $modelOrCollection->group_id,
			"question" => $modelOrCollection->{lang("question" , "ar")},
			"answer" => $modelOrCollection->{lang("answer" , "ar")},

        ];
    }

}