<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

  public $table = "faq";


   protected $fillable = [
        'group_id','question','answer'
   ];

   public function groups(){
	return $this->hasMany(Faq::class, "group_id");
	}

	public function getQuestionLangAttribute(){
		return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->{app()->getLocale()}  : $this->question;
	}
	public function getQuestionEnAttribute(){
		return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->en  : $this->question;
	}
	public function getQuestionArAttribute(){
		return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->ar  : $this->question;
	}
	public function getAnswerLangAttribute(){
		return is_json($this->answer) && is_object(json_decode($this->answer)) ?  json_decode($this->answer)->{app()->getLocale()}  : $this->answer;
	}
	public function getAnswerEnAttribute(){
		return is_json($this->answer) && is_object(json_decode($this->answer)) ?  json_decode($this->answer)->en  : $this->answer;
	}
	public function getAnswerArAttribute(){
		return is_json($this->answer) && is_object(json_decode($this->answer)) ?  json_decode($this->answer)->ar  : $this->answer;
	}

}
