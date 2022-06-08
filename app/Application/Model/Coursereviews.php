<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Coursereviews extends Model
{
   public $table = "coursereviews";


   const TYPE_DYNAMIC = 0;
   const TYPE_STATIC = 1;

   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'courses_id',
   'user_id',
        'review','rating','type','manual_name','manual_image',
         'is_report'
   ];
  }
