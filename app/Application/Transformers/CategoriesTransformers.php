<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CategoriesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "en")},
			"slug" => $modelOrCollection->slug,
			"desc" => $modelOrCollection->{lang("desc" , "en")},
			"parent_id" => $modelOrCollection->parent_id,
			"sort" => $modelOrCollection->sort,
			"status" => $modelOrCollection->status,
			"show_home" => $modelOrCollection->show_home,
			"show_menu" => $modelOrCollection->show_menu,
			"m_image" => $modelOrCollection->m_image,
			"d_image" => $modelOrCollection->d_image,
			"image" => $modelOrCollection->image,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "ar")},
			"slug" => $modelOrCollection->slug,
			"desc" => $modelOrCollection->{lang("desc" , "ar")},
			"parent_id" => $modelOrCollection->parent_id,
			"sort" => $modelOrCollection->sort,
			"status" => $modelOrCollection->status,
			"show_home" => $modelOrCollection->show_home,
			"show_menu" => $modelOrCollection->show_menu,
			"m_image" => $modelOrCollection->m_image,
			"d_image" => $modelOrCollection->d_image,
			"image" => $modelOrCollection->image,

        ];
    }

}