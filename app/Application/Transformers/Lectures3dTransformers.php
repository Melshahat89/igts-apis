<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class Lectures3dTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title,
			"link" => $modelOrCollection->link,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title,
			"link" => $modelOrCollection->link,

        ];
    }

}