<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class HomesettingsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"bundles" => $modelOrCollection->bundles,
			"featured_courses" => $modelOrCollection->featured_courses,
			"events" => $modelOrCollection->events,
			"talks" => $modelOrCollection->talks,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"bundles" => $modelOrCollection->bundles,
			"featured_courses" => $modelOrCollection->featured_courses,
			"events" => $modelOrCollection->events,
			"talks" => $modelOrCollection->talks,

        ];
    }

}