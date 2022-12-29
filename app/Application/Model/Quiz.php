<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Quiz extends Model
{
   public $table = "quiz";
   public function quizstudentsstatus(){
		return $this->hasMany(Quizstudentsstatus::class, "quiz_id");
		}
   public function quizstudentsanswers(){
  return $this->hasMany(Quizstudentsanswers::class, "quiz_id");
  }
   public function quizquestions(){
  return $this->hasMany(Quizquestions::class, "quiz_id");
  }
  
   public function coursesections(){
  return $this->belongsTo(Coursesections::class, "coursesections_id");
  }
   public function courses(){
  return $this->belongsTo(Courses::class, "courses_id");
  }
     protected $fillable = [
     'coursesections_id',
   'courses_id',
        'title','description','instructions','time','time_in_mins','type','pass_percentage'
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

 public function getQuizSumAttribute(){
  return $this->quizquestions->sum('mark');
 }
 public function getquizQuestionsCountAttribute(){
  return $this->quizquestions->COUNT();
 }

 public static function currentStudentMark($quizInstatntId){
               $result = Quizstudentsanswers::where('quizstudentsstatus_id',$quizInstatntId)->groupBy('quizquestionschoice_id')->get();
               $total = 0;
               foreach ($result as $row) {
                   $total += $row->mark;
               }
               return $total;
           }
 }
