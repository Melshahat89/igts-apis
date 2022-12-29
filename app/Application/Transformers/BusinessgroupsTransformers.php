<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class BusinessgroupsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"parent_id" => $modelOrCollection->parent_id,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"parent_id" => $modelOrCollection->parent_id,

        ];
    }

}