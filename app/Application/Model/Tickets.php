<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Tickets extends Model
{
   public $table = "tickets";
   public function ticketsreplay(){
		return $this->hasMany(Ticketsreplay::class, "tickets_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
   'user_id', //sender
        'reciver_id','status','type','title','message','priority'
   ];
  }
