<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class ProgressTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"percentage" => $modelOrCollection->percentage,
			"note" => $modelOrCollection->note,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"percentage" => $modelOrCollection->percentage,
			"note" => $modelOrCollection->note,

        ];
    }

}