<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PartnersTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"logo" => $modelOrCollection->logo,
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "en")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "en")},
			"search_keys[]" => $modelOrCollection->{lang("search_keys[]" , "en")},

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"logo" => $modelOrCollection->logo,
			"seo_desc[]" => $modelOrCollection->{lang("seo_desc[]" , "ar")},
			"seo_keys[]" => $modelOrCollection->{lang("seo_keys[]" , "ar")},
			"search_keys[]" => $modelOrCollection->{lang("search_keys[]" , "ar")},

        ];
    }

}