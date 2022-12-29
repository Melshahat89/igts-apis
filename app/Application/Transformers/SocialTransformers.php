<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class SocialTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"user_id" => $modelOrCollection->user_id,
			"provider" => $modelOrCollection->provider,
			"identifier" => $modelOrCollection->identifier,
			"profile_cache" => $modelOrCollection->profile_cache,
			"session_data" => $modelOrCollection->session_data,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"user_id" => $modelOrCollection->user_id,
			"provider" => $modelOrCollection->provider,
			"identifier" => $modelOrCollection->identifier,
			"profile_cache" => $modelOrCollection->profile_cache,
			"session_data" => $modelOrCollection->session_data,

        ];
    }

}