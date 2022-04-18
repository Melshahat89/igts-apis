<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Promotioncourses extends Model
{
   public $table = "promotioncourses";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function promotions(){
  return $this->belongsTo(Promotions::class, "promotions_id");
  }
     protected $fillable = [
     'courses_id',
   'promotions_id',
        'note'
   ];
  }
