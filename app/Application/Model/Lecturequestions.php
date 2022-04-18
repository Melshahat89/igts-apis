<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Lecturequestions extends Model
{
   public $table = "lecturequestions";
   public function lecturequestionsanswers(){
		return $this->hasMany(Lecturequestionsanswers::class, "lecturequestions_id");
      }
      
   public function courselectures(){
  return $this->belongsTo(Courselectures::class, "courselectures_id");
  }
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'courselectures_id',
   'user_id',
        'question_title','question_description','approve'
   ];
  }
