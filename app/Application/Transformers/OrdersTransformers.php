<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class OrdersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,
			"comments" => $modelOrCollection->comments,
			"billing_address_id" => $modelOrCollection->billing_address_id,
			"accept_order_id" => $modelOrCollection->accept_order_id,
			"kiosk_id" => $modelOrCollection->kiosk_id,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"status" => $modelOrCollection->status,
			"comments" => $modelOrCollection->comments,
			"billing_address_id" => $modelOrCollection->billing_address_id,
			"accept_order_id" => $modelOrCollection->accept_order_id,
			"kiosk_id" => $modelOrCollection->kiosk_id,

        ];
    }

}