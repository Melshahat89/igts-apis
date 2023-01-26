<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class BecomeInstructorTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"phone" => $modelOrCollection->phone,
			"title" => $modelOrCollection->title,
			"specialist" => $modelOrCollection->specialist,
			"yourCourses" => $modelOrCollection->yourCourses,
			"cv" => large($modelOrCollection->cv),
			"socialAccount" => $modelOrCollection->socialAccount,

        ];
    }

}