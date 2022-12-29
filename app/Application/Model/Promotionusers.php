<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Promotionusers extends Model
{
   public $table = "promotionusers";
   public function orders(){
		return $this->belongsTo(Orders::class, "orders_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
   public function promotions(){
  return $this->belongsTo(Promotions::class, "promotions_id");
  }
     protected $fillable = [
     'orders_id',
     'user_id',
   'promotions_id',
        'used'
   ];


   
  }
