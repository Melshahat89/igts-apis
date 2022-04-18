<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"slug" => $modelOrCollection->slug,
			"description" => $modelOrCollection->{lang("description" , "en")},
			"welcome_message" => $modelOrCollection->{lang("welcome_message" , "en")},
			"congratulation_message" => $modelOrCollection->{lang("congratulation_message" , "en")},
			"type" => $modelOrCollection->type,
			"skill_level" => $modelOrCollection->skill_level,
			"language_id" => $modelOrCollection->language_id,
			"has_captions" => $modelOrCollection->has_captions,
			"has_certificate" => $modelOrCollection->has_certificate,
			"length" => $modelOrCollection->length,
			"price" => $modelOrCollection->price,
			"price_in_dollar" => $modelOrCollection->price_in_dollar,
			"affiliate1_per" => $modelOrCollection->affiliate1_per,
			"affiliate2_per" => $modelOrCollection->affiliate2_per,
			"affiliate3_per" => $modelOrCollection->affiliate3_per,
			"affiliate4_per" => $modelOrCollection->affiliate4_per,
			"instructor_per" => $modelOrCollection->instructor_per,
			"discount_egp" => $modelOrCollection->discount_egp,
			"discount_usd" => $modelOrCollection->discount_usd,
			"featured" => $modelOrCollection->featured,
			"image" => $modelOrCollection->image,
			"promo_video" => $modelOrCollection->promo_video,
			"visits" => $modelOrCollection->visits,
			"published" => $modelOrCollection->published,
			"position" => $modelOrCollection->position,
			"sort" => $modelOrCollection->sort,
			"doctor_name" => $modelOrCollection->{lang("doctor_name" , "en")},
			"full_access" => $modelOrCollection->full_access,
			"access_time" => $modelOrCollection->access_time,
			"soon" => $modelOrCollection->soon,
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "en")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "en")},
			"search_keys[]" => $modelOrCollection->{lang("search_keys[]" , "en")},
			"poster" => $modelOrCollection->poster,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"slug" => $modelOrCollection->slug,
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"welcome_message" => $modelOrCollection->{lang("welcome_message" , "ar")},
			"congratulation_message" => $modelOrCollection->{lang("congratulation_message" , "ar")},
			"type" => $modelOrCollection->type,
			"skill_level" => $modelOrCollection->skill_level,
			"language_id" => $modelOrCollection->language_id,
			"has_captions" => $modelOrCollection->has_captions,
			"has_certificate" => $modelOrCollection->has_certificate,
			"length" => $modelOrCollection->length,
			"price" => $modelOrCollection->price,
			"price_in_dollar" => $modelOrCollection->price_in_dollar,
			"affiliate1_per" => $modelOrCollection->affiliate1_per,
			"affiliate2_per" => $modelOrCollection->affiliate2_per,
			"affiliate3_per" => $modelOrCollection->affiliate3_per,
			"affiliate4_per" => $modelOrCollection->affiliate4_per,
			"instructor_per" => $modelOrCollection->instructor_per,
			"discount_egp" => $modelOrCollection->discount_egp,
			"discount_usd" => $modelOrCollection->discount_usd,
			"featured" => $modelOrCollection->featured,
			"image" => $modelOrCollection->image,
			"promo_video" => $modelOrCollection->promo_video,
			"visits" => $modelOrCollection->visits,
			"published" => $modelOrCollection->published,
			"position" => $modelOrCollection->position,
			"sort" => $modelOrCollection->sort,
			"doctor_name" => $modelOrCollection->{lang("doctor_name" , "ar")},
			"full_access" => $modelOrCollection->full_access,
			"access_time" => $modelOrCollection->access_time,
			"soon" => $modelOrCollection->soon,
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "ar")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "ar")},
			"search_keys[]" => $modelOrCollection->{lang("search_keys[]" , "ar")},
			"poster" => $modelOrCollection->poster,

        ];
    }

}