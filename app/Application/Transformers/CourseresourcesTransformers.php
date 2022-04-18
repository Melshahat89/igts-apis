<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CourseresourcesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"file" => $modelOrCollection->file,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"file" => $modelOrCollection->file,

        ];
    }

}