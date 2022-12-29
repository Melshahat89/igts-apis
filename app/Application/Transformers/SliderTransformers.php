<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class SliderTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"image_m_ar" => $modelOrCollection->image_m_ar,
			"image_m_en" => $modelOrCollection->image_m_en,
			"image_d_ar" => $modelOrCollection->image_d_ar,
			"image_d_en" => $modelOrCollection->image_d_en,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"image_m_ar" => $modelOrCollection->image_m_ar,
			"image_m_en" => $modelOrCollection->image_m_en,
			"image_d_ar" => $modelOrCollection->image_d_ar,
			"image_d_en" => $modelOrCollection->image_d_en,
			"status" => $modelOrCollection->status,

        ];
    }

}