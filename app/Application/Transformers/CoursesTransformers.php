<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"slug" => $modelOrCollection->slug,
			"description" => $modelOrCollection->description_lang,
			"welcome_message" => $modelOrCollection->welcome_message_lang,
			"congratulation_message" => $modelOrCollection->congratulation_message_lang,
			"type" => $modelOrCollection->type,
			"skill_level" => $modelOrCollection->skill_level,
			"language_id" => $modelOrCollection->language_id,
			"has_captions" => $modelOrCollection->has_captions,
			"has_certificate" => $modelOrCollection->has_certificate,
			"length" => $modelOrCollection->length,
			"price" => $modelOrCollection->price,
			"price_in_dollar" => $modelOrCollection->price_in_dollar,
			"discount_egp" => $modelOrCollection->discount_egp,
			"discount_usd" => $modelOrCollection->discount_usd,
			"featured" => $modelOrCollection->featured,
			"image" => $modelOrCollection->image,
			"promo_video" => $modelOrCollection->promo_video,
			"visits" => $modelOrCollection->visits,
			"published" => $modelOrCollection->published,
			"position" => $modelOrCollection->position,
			"sort" => $modelOrCollection->sort,
			"doctor_name" => $modelOrCollection->doctor_name_lang,
			"full_access" => $modelOrCollection->full_access,
			"access_time" => $modelOrCollection->access_time,
			"soon" => $modelOrCollection->soon,
			"seo_desc" => $modelOrCollection->Seodesc_lang,
			"seo_keys" => $modelOrCollection->Seokeys_lang,
			"search_keys" => $modelOrCollection->Searchkeys_lang,
			"poster" => $modelOrCollection->poster,
            "rating" => $modelOrCollection->CourseRating,
            "courseCountRating" => $modelOrCollection->CourseCountRating,
            "priceBase" => $modelOrCollection->PriceBase,

        ];
    }
}