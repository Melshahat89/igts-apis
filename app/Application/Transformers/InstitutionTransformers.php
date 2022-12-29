<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class InstitutionTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"temp1" => $modelOrCollection->temp1,
			"temp2" => $modelOrCollection->temp2,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"temp1" => $modelOrCollection->temp1,
			"temp2" => $modelOrCollection->temp2,

        ];
    }

}