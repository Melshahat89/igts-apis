<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Courseenrollment extends Model
{
   public $table = "courseenrollment";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'courses_id',
      'user_id',
        'start_time','end_time','status'
   ];
  }
