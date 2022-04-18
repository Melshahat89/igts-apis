<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TicketsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"reciver_id" => $modelOrCollection->reciver_id,
			"status" => $modelOrCollection->status,
			"type" => $modelOrCollection->type,
			"title" => $modelOrCollection->title,
			"message" => $modelOrCollection->message,
			"priority" => $modelOrCollection->priority,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"reciver_id" => $modelOrCollection->reciver_id,
			"status" => $modelOrCollection->status,
			"type" => $modelOrCollection->type,
			"title" => $modelOrCollection->title,
			"message" => $modelOrCollection->message,
			"priority" => $modelOrCollection->priority,

        ];
    }

}