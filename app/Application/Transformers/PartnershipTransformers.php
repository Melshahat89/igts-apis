<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PartnershipTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"setting" => $modelOrCollection->setting,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"setting" => $modelOrCollection->setting,

        ];
    }

}