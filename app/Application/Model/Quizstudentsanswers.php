<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Quizstudentsanswers extends Model
{
   public $table = "quizstudentsanswers";
   public function quizstudentsstatus(){
		return $this->belongsTo(Quizstudentsstatus::class, "quizstudentsstatus_id");
		}
   public function quiz(){
  return $this->belongsTo(Quiz::class, "quiz_id");
  }
   public function quizquestions(){
  return $this->belongsTo(Quizquestions::class, "quizquestions_id");
  }
   public function quizquestionschoice(){
  return $this->belongsTo(Quizquestionschoice::class, "quizquestionschoice_id");
  }

   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'quizstudentsstatus_id',
     'quiz_id',
     'quizquestions_id',
     'quizquestionschoice_id',
   'user_id',
        'is_correct','answered','mark'
   ];
  }
