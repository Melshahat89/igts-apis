<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Promotionactive extends Model
{
    public $table = "promotionactive";
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function promotions()
    {
        return $this->belongsTo(Promotions::class, "promotions_id");
    }
    protected $fillable = [
        'user_id',
        'promotions_id',
        'status',
    ];

   public static function setActivePromo($promotions_id)
   {

      // // ********* Clear Other Active Promo *********
      // Promotionactive::where('user_id',Auth::user()->id)->where('status',1)->update(array('status' => 0));


      // ********* Set Active Promo *********
      $promotionActive = new Promotionactive();
      $promotionActive->promotions_id = $promotions_id;
      $promotionActive->user_id = Auth::user()->id;
      $promotionActive->status = 1;
      $promotionActive->save();

      if ($promotionActive->save()) {
         return $promotionActive;
      }
      return FALSE;
   }
   
   public static function removeActivePromo($user_id = null)
   {
    $user_id = ($user_id) ? $user_id : Auth::user()->id;
      // // ********* Clear Other Active Promo *********
      Promotionactive::where('user_id',$user_id)->where('status',1)->update(array('status' => 0));
      
      return TRUE;
   }


   static function updateOrderPositions($user_id = null)
   {
    $user_id = ($user_id) ? $user_id : Auth::user()->id;
      
    $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
        $query->where('status', Orders::STATUS_PENDING)
        ;
    })->orderBy('id', 'DESC')->first();

    if($order){
        foreach($order->ordersposition as $orderPosition){
            if($orderPosition->type == Ordersposition::TYPE_Course){  //Course
                $course = Courses::find($orderPosition->courses_id);
                $orderPosition->amount = $course->OriginalPrice;

            }elseif($orderPosition->type == Ordersposition::TYPE_Event){   //Event
                $event = Events::find($orderPosition->events_id);
                $orderPosition->amount = $event->OriginalPrice;
            }elseif($orderPosition->type == Ordersposition::TYPE_CERTIFICATE){
                $certificate = Certificates::find($orderPosition->certificate_id);
                $orderPosition->amount = $certificate->Price;
            }
            $orderPosition->currency = getCurrency();
            $orderPosition->save();
        }
    }





      return TRUE;
   }



}
