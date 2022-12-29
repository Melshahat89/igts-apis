<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class CoursesectionsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
            "title" => $modelOrCollection->title_lang,
            "length" => $modelOrCollection->length,
            "lecturesCount" => count($modelOrCollection->courselectures),
            "LecturesLenght" => ($modelOrCollection->HoursLectures),
            "Lectures" => CourselecturesTransformers::transform($modelOrCollection->courselectures) ,
        ];
    }

}