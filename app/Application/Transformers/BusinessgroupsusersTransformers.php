<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class BusinessgroupsusersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,
			"note" => $modelOrCollection->note,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,
			"note" => $modelOrCollection->note,

        ];
    }

}