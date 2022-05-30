<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

 class UserTransformers extends AbstractTransformer
{
     public function transformModel(Model $modelOrCollection)
     {
         return [
             'id' => $modelOrCollection->id,
             'slug' => $modelOrCollection->slug,
             'group_id' => $modelOrCollection->group_id,
             'name' => $modelOrCollection->name,
             'email' => $modelOrCollection->email,
             'mobile' => $modelOrCollection->mobile,
             'first_name' => $modelOrCollection->{lang("first_name" , "en")},
             'last_name' => $modelOrCollection->{lang("last_name" , "en")},
             'birthdate' => $modelOrCollection->birthdate,
             'title' => $modelOrCollection->{lang("title" , "en")},
             'about' => $modelOrCollection->{lang("about" , "en")},
             'description' => $modelOrCollection->{lang("description" , "en")},
             'image' => $modelOrCollection->image,
             'cover' => $modelOrCollection->cover,
             'token' => $modelOrCollection->api_token,
             'businessdata_id' => $modelOrCollection->businessdata_id,
             'facebook_identifier' => $modelOrCollection->facebook_identifier,
             'token' => $modelOrCollection->createToken('MyApp')->accessToken,
         ];
     }
     public function transformModelAr(Model $modelOrCollection)
     {
         return [
             'id' => $modelOrCollection->id,
             'slug' => $modelOrCollection->slug,
             'group_id' => $modelOrCollection->group_id,
             'name' => $modelOrCollection->name,
             'email' => $modelOrCollection->email,
             'mobile' => $modelOrCollection->mobile,
             'first_name' => $modelOrCollection->{lang("first_name" , "ar")},
             'last_name' => $modelOrCollection->{lang("last_name" , "ar")},
             'birthdate' => $modelOrCollection->birthdate,
             'title' => $modelOrCollection->{lang("title" , "ar")},
             'about' => $modelOrCollection->{lang("about" , "ar")},
             'description' => $modelOrCollection->{lang("description" , "ar")},
             'image' => $modelOrCollection->image,
             'cover' => $modelOrCollection->cover,
             'token' => $modelOrCollection->api_token,
             'businessdata_id' => $modelOrCollection->businessdata_id,
             'facebook_identifier' => $modelOrCollection->facebook_identifier,
             'token' => $modelOrCollection->createToken('MyApp')->accessToken,
         ];
     }
}