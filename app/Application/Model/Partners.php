<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{

  public $table = "partners";


   protected $fillable = [
        'title','description','logo','seo_desc','seo_keys','search_keys'
   ];

	public function getTitleLangAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{app()->getLocale()}  : $this->title;
	}
	public function getTitleEnAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
	}
	public function getTitleArAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
	}
	public function getDescriptionLangAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->{app()->getLocale()}  : $this->description;
	}
	public function getDescriptionEnAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->en  : $this->description;
	}
	public function getDescriptionArAttribute(){
		return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->ar  : $this->description;
	}
	public function getSeo_descLangAttribute(){
		return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->{app()->getLocale()}  : $this->seo_desc;
	}
	public function getSeo_descEnAttribute(){
		return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->en  : $this->seo_desc;
	}
	public function getSeo_descArAttribute(){
		return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->ar  : $this->seo_desc;
	}
	public function getSeo_keysLangAttribute(){
		return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->{app()->getLocale()}  : $this->seo_keys;
	}
	public function getSeo_keysEnAttribute(){
		return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->en  : $this->seo_keys;
	}
	public function getSeo_keysArAttribute(){
		return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->ar  : $this->seo_keys;
	}
	public function getSearch_keysLangAttribute(){
		return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ?  json_decode($this->search_keys)->{app()->getLocale()}  : $this->search_keys;
	}
	public function getSearch_keysEnAttribute(){
		return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ?  json_decode($this->search_keys)->en  : $this->search_keys;
	}
	public function getSearch_keysArAttribute(){
		return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ?  json_decode($this->search_keys)->ar  : $this->search_keys;
	}

}
