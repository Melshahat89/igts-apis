<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TalklikesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"comment" => $modelOrCollection->comment,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"comment" => $modelOrCollection->comment,
			"status" => $modelOrCollection->status,

        ];
    }

}