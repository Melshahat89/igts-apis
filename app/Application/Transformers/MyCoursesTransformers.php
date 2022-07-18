<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class MyCoursesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "enroll_id" => $modelOrCollection->id,
            "enroll_start_time" => $modelOrCollection->start_time,
            "enroll_end_time" => $modelOrCollection->end_time,
            "enroll_status" => $modelOrCollection->status,



            "id" => $modelOrCollection['courses']->id,
			"title" => $modelOrCollection['courses']->title_lang,
			"slug" => $modelOrCollection['courses']->slug,
			"description" => $modelOrCollection['courses']->description_lang,
			"type" => $modelOrCollection['courses']->type,
			"skill_level" => $modelOrCollection['courses']->skill_level,
			"language_id" => $modelOrCollection['courses']->language_id,
			"price" => $modelOrCollection['courses']->price,
			"price_in_dollar" => $modelOrCollection['courses']->price_in_dollar,
			"image" => $modelOrCollection['courses']->image,
			"promo_video" => $modelOrCollection['courses']->promo_video,
			"visits" => $modelOrCollection['courses']->visits,
			"published" => $modelOrCollection['courses']->published,
			"doctor_name" => $modelOrCollection['courses']->doctor_name_lang,
			"access_time" => $modelOrCollection['courses']->access_time,
			"poster" => $modelOrCollection['courses']->poster,
            "rating" => $modelOrCollection['courses']->CourseRating,
            "courseCountRating" => $modelOrCollection['courses']->CourseCountRating,
            "priceBase" => $modelOrCollection['courses']->PriceBase,
            "progress" => $modelOrCollection['courses']->CourseProgress,
            "courseLectures" => $modelOrCollection['courses']->CourseCountLectures,
        ];
    }
}