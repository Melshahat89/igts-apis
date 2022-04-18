<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Courserelated extends Model
{
   public $table = "courserelated";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function relatedCourse(){
		return $this->belongsTo(Courses::class, "related_course_id");
		}
     protected $fillable = [
   'courses_id',
   'related_course_id',
        'position'
   ];
  }
