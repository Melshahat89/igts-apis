<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Quizquestionschoice extends Model
{
   public $table = "quizquestionschoice";
   public function quizstudentsanswers(){
		return $this->hasMany(Quizstudentsanswers::class, "quizquestionschoice_id");
		}
   public function quizquestions(){
  return $this->belongsTo(Quizquestions::class, "quizquestions_id");
  }
     protected $fillable = [
   'quizquestions_id',
        'choice','is_correct'
   ];
  public function getChoiceLangAttribute(){
  return is_json($this->choice) && is_object(json_decode($this->choice)) ?  json_decode($this->choice)->{getCurrentLang()}  : $this->choice;
 }
 public function getChoiceEnAttribute(){
  return is_json($this->choice) && is_object(json_decode($this->choice)) ?  json_decode($this->choice)->en  : $this->choice;
 }
 public function getChoiceArAttribute(){
  return is_json($this->choice) && is_object(json_decode($this->choice)) ?  json_decode($this->choice)->ar  : $this->choice;
 }
 }
