<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

 class InstructorsTransformers extends AbstractTransformer
{
     public function transformModel(Model $modelOrCollection)
     {
         return [
             'id' => $modelOrCollection->id,
             'slug' => $modelOrCollection->slug,
             'name' => $modelOrCollection->name,
             'email' => $modelOrCollection->email,
             'mobile' => $modelOrCollection->mobile,
             'first_name' => $modelOrCollection->first_name_lang,
             'last_name' => $modelOrCollection->last_name_lang,
             'birthdate' => $modelOrCollection->birthdate,
             'title' => $modelOrCollection->title_lang,
             'about' => $modelOrCollection->about_lang,
             'description' => $modelOrCollection->about_lang,
             'image' => $modelOrCollection->image,
             'cover' => $modelOrCollection->cover,
             'coursesViews' => $modelOrCollection->instructorCoursesViews,
             'enrolledCountStudents' => $modelOrCollection->EnrolledCountStudents,
             'instructorRating' => $modelOrCollection->InstructorRating,
         ];
     }
 }