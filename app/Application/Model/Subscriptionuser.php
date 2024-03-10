<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;

 class Subscriptionuser extends Model
{
   public $table = "subscriptionuser";

     public function courseenrollment(){
         return $this->hasMany(Courseenrollment::class, "subscriptionuser_id");
     }

     const SUBSCRIPTION_MONTHLY = 1;
     const SUBSCRIPTION_YEARLY = 2;
     const SUBSCRIPTION_BUSINESS_TYPE_B2B = 0;
     const SUBSCRIPTION_BUSINESS_TYPE_B2C = 1;



   public function orders(){
		return $this->belongsTo(Orders::class, "orders_id");
		}
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'orders_id',
   'user_id',
        'subscription_id','start_date','end_date','amount','b_type','is_active','is_collected'
   ];
  }
