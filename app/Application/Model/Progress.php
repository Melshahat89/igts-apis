<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
   public $table = "progress";
   public function courselectures()
   {
      return $this->belongsTo(Courselectures::class, "courselectures_id");
   }
   public function courses()
   {
      return $this->belongsTo(Courses::class, "courses_id");
   }
   public function user()
   {
      return $this->belongsTo(User::class, "user_id");
   }
   protected $fillable = [
      'courselectures_id',
      'courses_id',
      'user_id',
      'percentage', 'note'
   ];


   public static function getLectureProgress($userID,$courseID){
      
      $course = Courses::find($courseID);
      $countProgress = Progress::where('user_id',$userID)->where('percentage',1)->where('courses_id',$courseID)->count();

      $percent = ((int) $course->CourseCountLectures > 0) ? ( ((int) $countProgress / (int) $course->CourseCountLectures) * 100 ) : 0;

      return $percent;
      
   }
}
