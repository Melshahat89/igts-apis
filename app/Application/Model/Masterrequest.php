<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Masterrequest extends Model
{
   public $table = "masterrequest";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'courses_id',
   'user_id',
        'qualification','collage_name','section','g_year','address','documentation','status'
   ];
  }
