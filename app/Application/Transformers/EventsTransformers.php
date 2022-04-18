<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class EventsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"image" => $modelOrCollection->image,
			"is_free" => $modelOrCollection->is_free,
			"price_egp" => $modelOrCollection->price_egp,
			"price_usd" => $modelOrCollection->price_usd,
			"type" => $modelOrCollection->type,
			"status" => $modelOrCollection->status,
			"location" => $modelOrCollection->location,
			"live_link" => $modelOrCollection->live_link,
			"recorded_link" => $modelOrCollection->recorded_link,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"image" => $modelOrCollection->image,
			"is_free" => $modelOrCollection->is_free,
			"price_egp" => $modelOrCollection->price_egp,
			"price_usd" => $modelOrCollection->price_usd,
			"type" => $modelOrCollection->type,
			"status" => $modelOrCollection->status,
			"location" => $modelOrCollection->location,
			"live_link" => $modelOrCollection->live_link,
			"recorded_link" => $modelOrCollection->recorded_link,

        ];
    }

}