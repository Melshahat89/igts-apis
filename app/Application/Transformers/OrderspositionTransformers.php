<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class OrderspositionTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"amount" => $modelOrCollection->amount,
			"notes" => $modelOrCollection->notes,
			"certificate_id" => $modelOrCollection->certificate_id,
			"shipping_id" => $modelOrCollection->shipping_id,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"amount" => $modelOrCollection->amount,
			"notes" => $modelOrCollection->notes,
			"certificate_id" => $modelOrCollection->certificate_id,
			"shipping_id" => $modelOrCollection->shipping_id,
			"status" => $modelOrCollection->status,

        ];
    }

}