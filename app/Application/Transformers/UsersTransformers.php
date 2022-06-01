<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

 class UsersTransformers extends AbstractTransformer
{
     public function transformModel(Model $modelOrCollection)
     {
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
             'image' => $modelOrCollection->image,
             'cover' => $modelOrCollection->cover,
             'token' => $modelOrCollection->api_token,
             'businessdata_id' => $modelOrCollection->businessdata_id,
             'facebook_identifier' => $modelOrCollection->facebook_identifier,
             'otp' => $modelOrCollection->otp,
             'enrolled_courses' => count($modelOrCollection->courseenrollment),
         ];
     }
}