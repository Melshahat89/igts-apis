<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Promotionevents extends Model
{
   public $table = "promotionevents";
   public function events(){
		return $this->belongsTo(Events::class, "events_id");
		}
   public function promotions(){
  return $this->belongsTo(Promotions::class, "promotions_id");
  }
     protected $fillable = [
     'events_id',
   'promotions_id',
        
   ];
  }
