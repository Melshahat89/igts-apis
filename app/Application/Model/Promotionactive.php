<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Promotionactive extends Model
{
    public $table = "promotionactive";
    const TYPE_B2C = 2;
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
        'type'
    ];

    public static function setActivePromo($promotions_id, $type=null)
    {
        // // ********* Clear Other Active Promo *********
        // Promotionactive::where('user_id',Auth::user()->id)->where('status',1)->update(array('status' => 0));

        $promotionActive = Promotionactive::where('user_id', Auth::user()->id)->where('promotions_id', $promotions_id)->where('status', 0)->first();

        if(!$promotionActive){
            // ********* Set Active Promo *********
            $promotionActive = new Promotionactive();
            $promotionActive->promotions_id = $promotions_id;
            $promotionActive->user_id = Auth::user()->id;

        }

        $promotionActive->status = 1;
        $promotionActive->type = $type;
        $promotionActive->save();
        return $promotionActive;

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

        $order = getCurrentCartOrder();

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
            $order->currency = getCurrency();
            $order->save();
        }





        return TRUE;
    }



}
