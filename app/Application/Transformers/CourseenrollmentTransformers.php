<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CourseenrollmentTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"start_time" => $modelOrCollection->start_time,
			"end_time" => $modelOrCollection->end_time,
			"status" => $modelOrCollection->status,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"start_time" => $modelOrCollection->start_time,
			"end_time" => $modelOrCollection->end_time,
			"status" => $modelOrCollection->status,

        ];
    }

}