<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class EventsticketsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"code" => $modelOrCollection->code,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"code" => $modelOrCollection->code,

        ];
    }

}