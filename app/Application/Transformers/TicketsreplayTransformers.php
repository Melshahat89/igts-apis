<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TicketsreplayTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"message" => $modelOrCollection->message,
			"reciver_id" => $modelOrCollection->reciver_id,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"message" => $modelOrCollection->message,
			"reciver_id" => $modelOrCollection->reciver_id,

        ];
    }

}