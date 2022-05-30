<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Quizquestions extends Model
{
   public $table = "quizquestions";
   public function quizstudentsanswers(){
		return $this->hasMany(Quizstudentsanswers::class, "quizquestions_id");
		}
   public function quizquestionschoice(){
  return $this->hasMany(Quizquestionschoice::class, "quizquestions_id");
  }
  public function quizquestionschoicecorrect(){
   return $this->hasMany(Quizquestionschoice::class, "quizquestions_id")->where('is_correct', 1);
   }
   public function quiz(){
  return $this->belongsTo(Quiz::class, "quiz_id");
  }
     protected $fillable = [
   'quiz_id',
        'question','type','mark'
   ];
  public function getQuestionLangAttribute(){
  return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->{app()->getLocale()}  : $this->question;
 }
 public function getQuestionEnAttribute(){
  return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->en  : $this->question;
 }
 public function getQuestionArAttribute(){
  return is_json($this->question) && is_object(json_decode($this->question)) ?  json_decode($this->question)->ar  : $this->question;
 }
 }
