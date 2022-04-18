<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Talklikes extends Model
{
   public $table = "talklikes";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
   public function talks(){
  return $this->belongsTo(Talks::class, "talks_id");
  }
     protected $fillable = [
      'user_id',
      'talks_id',
      'comment','status'
   ];
  }
