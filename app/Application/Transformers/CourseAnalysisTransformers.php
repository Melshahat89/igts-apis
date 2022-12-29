<?php

namespace App\Application\Transformers;

use App\Application\Model\Courses;
use Illuminate\Database\Eloquent\Model;

class CourseAnalysisTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"slug" => $modelOrCollection->slug,
			"description" => htmlspecialchars(trim(strip_tags($modelOrCollection->Description_lang))),
			"type" => $modelOrCollection->type,
			"skill_level" => trans('website.Level'.$modelOrCollection->skill_level),
			"language_id" => trans('website.lang'.$modelOrCollection->language_id),
			"image" => $modelOrCollection->image,
			"promo_video" => $modelOrCollection->promo_video,
			"visits" => $modelOrCollection->visits,
			"doctor_name" => $modelOrCollection->instructor['Fullname_lang'],
			"poster" => $modelOrCollection->poster,
            "rating" => round($modelOrCollection->CourseRating,2),
            "courseCountRating" => $modelOrCollection->CourseCountRating,
            "priceBase" => $modelOrCollection->PriceBase,
            "courseCountStudents" => count($modelOrCollection->courseenrollment),
            "CourseRevenue" => round($modelOrCollection->CourseRevenue) ,
        ];
    }
}