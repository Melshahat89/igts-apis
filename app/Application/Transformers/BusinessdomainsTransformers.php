<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class BusinessdomainsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"domainname" => $modelOrCollection->domainname,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"domainname" => $modelOrCollection->domainname,
			"status" => $modelOrCollection->status,

        ];
    }

}