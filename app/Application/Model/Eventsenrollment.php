<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Eventsenrollment extends Model
{
   public $table = "eventsenrollment";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
   public function events(){
  return $this->belongsTo(Events::class, "events_id");
  }
     protected $fillable = [
     'user_id',
   'events_id',
        'start_time','end_time','status'
   ];
  }
