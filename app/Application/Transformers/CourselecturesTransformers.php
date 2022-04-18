<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CourselecturesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"slug" => $modelOrCollection->slug,
			"description" => $modelOrCollection->{lang("description" , "en")},
			"video_file" => $modelOrCollection->video_file,
			"length" => $modelOrCollection->length,
			"is_free" => $modelOrCollection->is_free,
			"position" => $modelOrCollection->position,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"slug" => $modelOrCollection->slug,
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"video_file" => $modelOrCollection->video_file,
			"length" => $modelOrCollection->length,
			"is_free" => $modelOrCollection->is_free,
			"position" => $modelOrCollection->position,

        ];
    }

}