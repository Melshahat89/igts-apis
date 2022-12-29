<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Courseincludes extends Model
{
   public $table = "courseincludes";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
          }
          public function includedCourse(){
               return $this->belongsTo(Courses::class, "included_course");
               }
     protected $fillable = [
   'courses_id',
   'included_course',
        'position',
        'included_course_title'
   ];
  }
