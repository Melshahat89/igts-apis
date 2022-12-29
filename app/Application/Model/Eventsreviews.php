<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Eventsreviews extends Model
{
   public $table = "eventsreviews";
   public function events(){
		return $this->belongsTo(Events::class, "events_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'events_id',
   'user_id',
        'review','rating'
   ];
  }
