<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TransactionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"price" => $modelOrCollection->price,
			"currency" => $modelOrCollection->currency,
			"percent" => $modelOrCollection->percent,
			"amount" => $modelOrCollection->amount,
			"type" => $modelOrCollection->type,
			"date" => $modelOrCollection->date,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"price" => $modelOrCollection->price,
			"currency" => $modelOrCollection->currency,
			"percent" => $modelOrCollection->percent,
			"amount" => $modelOrCollection->amount,
			"type" => $modelOrCollection->type,
			"date" => $modelOrCollection->date,

        ];
    }

}