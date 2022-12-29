<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CareersresponsesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"mobile" => $modelOrCollection->mobile,
			"file" => $modelOrCollection->file,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"mobile" => $modelOrCollection->mobile,
			"file" => $modelOrCollection->file,

        ];
    }

}