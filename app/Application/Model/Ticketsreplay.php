<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Ticketsreplay extends Model
{
   public $table = "ticketsreplay";
   public function tickets(){
		return $this->belongsTo(Tickets::class, "tickets_id");
		}
   public function sender(){
  return $this->belongsTo(User::class, "user_id");
  }

  public function reciver(){
   return $this->belongsTo(User::class, "reciver_id");
   }

     protected $fillable = [
     'tickets_id',
   'user_id',
        'message','reciver_id'
   ];
  }
