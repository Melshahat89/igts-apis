<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CourseresourcesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"file" => $modelOrCollection->file,

        ];
    }


}