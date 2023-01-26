<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TalksTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"slug" => $modelOrCollection->slug,
			"subtitle" => $modelOrCollection->{lang("subtitle" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"language_id" => $modelOrCollection->language_id,
			"length" => $modelOrCollection->length,
			"featured" => $modelOrCollection->featured,
			"published" => $modelOrCollection->published,
			"visits" => $modelOrCollection->visits,
			"video_file" => $modelOrCollection->video_file,
			"sort" => $modelOrCollection->sort,
			"doctor_name" => $modelOrCollection->{lang("doctor_name" , "en")},
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "en")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "en")},
			"search_keys[]" => $modelOrCollection->search_keys,
			"image" => large($modelOrCollection->image),
			"promoPoster" => large($modelOrCollection->promoPoster),
			"cover" => large($modelOrCollection->cover),

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"slug" => $modelOrCollection->slug,
			"subtitle" => $modelOrCollection->{lang("subtitle" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"language_id" => $modelOrCollection->language_id,
			"length" => $modelOrCollection->length,
			"featured" => $modelOrCollection->featured,
			"published" => $modelOrCollection->published,
			"visits" => $modelOrCollection->visits,
			"video_file" => $modelOrCollection->video_file,
			"sort" => $modelOrCollection->sort,
			"doctor_name" => $modelOrCollection->{lang("doctor_name" , "ar")},
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "ar")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "ar")},
			"search_keys[]" => $modelOrCollection->search_keys,
			"image" => $modelOrCollection->image,
			"promoPoster" => $modelOrCollection->promoPoster,
			"cover" => $modelOrCollection->cover,

        ];
    }

}