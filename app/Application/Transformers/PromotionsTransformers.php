<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PromotionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title,
			"description" => $modelOrCollection->description,
			"type" => $modelOrCollection->type,
			"value_for_egp" => $modelOrCollection->value_for_egp,
			"value_for_other_currencies" => $modelOrCollection->value_for_other_currencies,
			"code" => $modelOrCollection->code,
			"start_date" => $modelOrCollection->start_date,
			"expiration_date" => $modelOrCollection->expiration_date,
			"active" => $modelOrCollection->active,
			"promotion_limit" => $modelOrCollection->promotion_limit,
			"promotion_usage" => $modelOrCollection->promotion_usage,
			"publish_as_notification" => $modelOrCollection->publish_as_notification,
			"notification_message" => $modelOrCollection->notification_message,
			"include_courses" => $modelOrCollection->include_courses,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title,
			"description" => $modelOrCollection->description,
			"type" => $modelOrCollection->type,
			"value_for_egp" => $modelOrCollection->value_for_egp,
			"value_for_other_currencies" => $modelOrCollection->value_for_other_currencies,
			"code" => $modelOrCollection->code,
			"start_date" => $modelOrCollection->start_date,
			"expiration_date" => $modelOrCollection->expiration_date,
			"active" => $modelOrCollection->active,
			"promotion_limit" => $modelOrCollection->promotion_limit,
			"promotion_usage" => $modelOrCollection->promotion_usage,
			"publish_as_notification" => $modelOrCollection->publish_as_notification,
			"notification_message" => $modelOrCollection->notification_message,
			"include_courses" => $modelOrCollection->include_courses,

        ];
    }

}