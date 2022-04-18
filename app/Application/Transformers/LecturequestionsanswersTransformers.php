<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class LecturequestionsanswersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"answer" => $modelOrCollection->answer,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"answer" => $modelOrCollection->answer,

        ];
    }

}