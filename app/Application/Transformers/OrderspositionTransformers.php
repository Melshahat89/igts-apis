<?php

namespace App\Application\Transformers;

use App\Application\Model\Ordersposition;
use Illuminate\Database\Eloquent\Model;

class OrderspositionTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
            "title" => ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ? $modelOrCollection->courses['title_lang'] : ''):null,
            "image" => ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ? 'https://igtsservice.com/uploads/files/medium/'.$modelOrCollection->courses['image'] : '' ):null,
            "original_price" =>  ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ?  $modelOrCollection->courses['priceBase'] : ''):null,
            "rating" =>  ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ? $modelOrCollection->courses['CourseRating'] : ''):null,
            "courseCountRating" =>  ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ? $modelOrCollection->courses['CourseCountRating'] : ''):null,
            "slug" =>  ($modelOrCollection->type == Ordersposition::TYPE_Course)?($modelOrCollection->courses ? $modelOrCollection->courses['slug'] : ''):null,
			"amount" => $modelOrCollection->amount,
			"notes" => $modelOrCollection->notes,
			"certificate_id" => $modelOrCollection->certificate_id,
			"shipping_id" => $modelOrCollection->shipping_id,
			"status" => $modelOrCollection->status,
			"orders_id" => $modelOrCollection->orders_id,
			"courses_id" => $modelOrCollection->courses_id,
			"user_id" => $modelOrCollection->user_id,
			"quantity" => $modelOrCollection->quantity,
			"unit_price" => $modelOrCollection->unit_price,
			"done" => $modelOrCollection->done,
			"type" => $modelOrCollection->type,
			"events_id" => $modelOrCollection->events_id,
			"currency" => $modelOrCollection->currency,
        ];
    }

}