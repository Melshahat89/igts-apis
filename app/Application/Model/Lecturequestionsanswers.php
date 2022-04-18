<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Lecturequestionsanswers extends Model
{
   public $table = "lecturequestionsanswers";
   public function lecturequestions(){
		return $this->belongsTo(Lecturequestions::class, "lecturequestions_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'lecturequestions_id',
   'user_id',
        'answer'
   ];
  }
