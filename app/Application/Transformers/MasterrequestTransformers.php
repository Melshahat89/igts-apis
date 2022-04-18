<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class MasterrequestTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"qualification" => $modelOrCollection->qualification,
			"collage_name" => $modelOrCollection->collage_name,
			"section" => $modelOrCollection->section,
			"g_year" => $modelOrCollection->g_year,
			"address" => $modelOrCollection->address,
			"documentation[]" => $modelOrCollection->documentation[],

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"qualification" => $modelOrCollection->qualification,
			"collage_name" => $modelOrCollection->collage_name,
			"section" => $modelOrCollection->section,
			"g_year" => $modelOrCollection->g_year,
			"address" => $modelOrCollection->address,
			"documentation[]" => $modelOrCollection->documentation[],

        ];
    }

}