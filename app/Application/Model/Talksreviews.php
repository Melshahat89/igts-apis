<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Talksreviews extends Model
{
   public $table = "talksreviews";
   public function talks(){
		return $this->belongsTo(Talks::class, "talks_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'talks_id',
   'user_id',
        'review','rating'
   ];
  }
