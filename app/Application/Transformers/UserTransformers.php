<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserTransformers extends AbstractTransformer
{
     public function transformModel(Model $modelOrCollection)
     {
         $dateNow = date('Y-m-d H:i:s');
         return [
             'id' => $modelOrCollection->id,
//             'slug' => $modelOrCollection->slug,
             'group_id' => $modelOrCollection->group_id,
             'name' => $modelOrCollection->name,
             'email' => $modelOrCollection->email,
             'mobile' => $modelOrCollection->mobile,
//             'first_name' => $modelOrCollection->first_name_lang,
//             'last_name' => $modelOrCollection->last_name_lang,
             'birthdate' => $modelOrCollection->birthdate,
//             'title' => $modelOrCollection->title_lang,
             'about' => $modelOrCollection->about_lang,
//             'description' => $modelOrCollection->description_lang,
             'image' => large($modelOrCollection->image),
             'cover' => large($modelOrCollection->cover),
             'businessdata_id' => $modelOrCollection->businessdata_id,
             'facebook_identifier' => $modelOrCollection->facebook_identifier,
             'token' => $modelOrCollection->createToken('MyApp')->accessToken,
//             'enrolled_courses' => count($modelOrCollection->courseenrollment()->whereDate('start_time', '<=', $dateNow)
//                 ->whereDate('end_time', '>=', $dateNow)
//                 ->where('status', 1)->get()->toArray()),
             'enrolled_courses' => count(hideIncludedCourses()),
             'last_course' => $modelOrCollection->lastcourse,
             'reviews' => $modelOrCollection->Userreviews,
             'cart_count' => $modelOrCollection->cartcount,
         ];
     }
}