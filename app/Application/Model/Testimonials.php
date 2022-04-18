<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{

  public $table = "testimonials";


   protected $fillable = [
        'name','title','message','image'
   ];

	public function getNameLangAttribute(){
		return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->{getCurrentLang()}  : $this->name;
	}
	public function getNameEnAttribute(){
		return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->en  : $this->name;
	}
	public function getNameArAttribute(){
		return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->ar  : $this->name;
	}
	public function getTitleLangAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{getCurrentLang()}  : $this->title;
	}
	public function getTitleEnAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
	}
	public function getTitleArAttribute(){
		return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
	}
	public function getMessageLangAttribute(){
		return is_json($this->message) && is_object(json_decode($this->message)) ?  json_decode($this->message)->{getCurrentLang()}  : $this->message;
	}
	public function getMessageEnAttribute(){
		return is_json($this->message) && is_object(json_decode($this->message)) ?  json_decode($this->message)->en  : $this->message;
	}
	public function getMessageArAttribute(){
		return is_json($this->message) && is_object(json_decode($this->message)) ?  json_decode($this->message)->ar  : $this->message;
	}

}
