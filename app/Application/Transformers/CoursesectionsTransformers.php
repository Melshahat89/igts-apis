<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursesectionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"will_do_at_the_end" => $modelOrCollection->{lang("will_do_at_the_end" , "en")},
			"position" => $modelOrCollection->position,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"will_do_at_the_end" => $modelOrCollection->{lang("will_do_at_the_end" , "ar")},
			"position" => $modelOrCollection->position,

        ];
    }

}