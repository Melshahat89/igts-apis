<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Businesscourses extends Model
{
   public $table = "businesscourses";
   public function courses()
   {
      return $this->belongsTo(Courses::class, "courses_id");
   }
   public function businessdata()
   {
      return $this->belongsTo(Businessdata::class, "businessdata_id");
   }
   protected $fillable = [
      'courses_id',
      'businessdata_id',
      'comment', 'status'
   ];
}
