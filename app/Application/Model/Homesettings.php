<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Homesettings extends Model
{

  public $table = "homesettings";


   protected $fillable = [
        'bundles','featured_courses','events','talks','masters','courses_discount','bundle_discount','masters_discount','diplomas_discount', 'seo_title', 'seo_desc', 'seo_keys'
   ];


   public function getSeotitleLangAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->{app()->getLocale()} : $this->seo_title;
   }
   public function getSeotitleEnAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->en : $this->seo_title;
   }
   public function getSeotitleArAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->ar : $this->seo_title;
   }
   
   public function getSeodescLangAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->{app()->getLocale()} : $this->seo_desc;
   }
   public function getSeodescEnAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->en : $this->seo_desc;
   }
   public function getSeodescArAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->ar : $this->seo_desc;
   }
   public function getSeo_keysLangAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->{app()->getLocale()} : $this->seo_keys;
   }
   public function getSeo_keysEnAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->en : $this->seo_keys;
   }
   public function getSeo_keysArAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->ar : $this->seo_keys;
   }

}
