<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class SimpleCourseTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"slug" => $modelOrCollection->slug,
//			"description" => $modelOrCollection->description_lang,
			"type" => $modelOrCollection->type,
			"featured" => $modelOrCollection->featured,
			"image" => large($modelOrCollection->image),
			"doctor_name" => $modelOrCollection->instructor['Fullname_lang'],
			"poster" => $modelOrCollection->poster,
            "rating" => $modelOrCollection->CourseRating,
            "courseCountRating" => $modelOrCollection->CourseCountRating,
            "priceBase" => $modelOrCollection->PriceBase,
        ];
    }
}