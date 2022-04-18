<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Eventstickets extends Model
{
   public $table = "eventstickets";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
   public function events(){
  return $this->belongsTo(Events::class, "events_id");
  }
   public function eventsdata(){
  return $this->belongsTo(Eventsdata::class, "eventsdata_id");
  }
     protected $fillable = [
     'user_id',
     'events_id',
     'eventsdata_id',
        'name','email','code'
   ];
  }
