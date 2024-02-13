<?php

namespace App\Application\Transformers;

use App\Application\Model\Courses;
use Illuminate\Database\Eloquent\Model;

class CourselectureTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->title_lang,
			"length" => timeLength($modelOrCollection->length)  ,
			"is_free" => $modelOrCollection->is_free,
			"description" => $modelOrCollection->description_lang,
			"video_file" => $modelOrCollection->video_file,
			"vdocipher" =>  $response =  Courses::getVdoCipherOTP( $modelOrCollection->vdocipher_id),
			"vdocipher_id" => $modelOrCollection->vdocipher_id,
			"vimeoVideo" => Courses::getVimeoVideo( $modelOrCollection->video_file),
			"courses_id" => $modelOrCollection->courses_id,
			"video_type" => $modelOrCollection->video_type, //0= videocipher , 1= vimeo
        ];
    }


}