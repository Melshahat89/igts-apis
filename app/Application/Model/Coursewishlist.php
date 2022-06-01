<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Coursewishlist extends Model
{
   public $table = "coursewishlist";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
         'courses_id',
         'user_id',
         'note'
   ];
  }
