<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Promotions extends Model
{
    public $table = "promotions";


    const TYPE_FIXED = 0;
    const TYPE_PERCENT = 1;
    const TYPE_B2C_FIXED = 2;
    const TYPE_B2C_PERCENT = 3;


    public function promotionactive()
    {
        return $this->hasMany(Promotionactive::class, "promotions_id");
    }
    public function promotioncourses()
    {
        return $this->hasMany(Promotioncourses::class, "promotions_id");
    }

    public function promotionevents()
    {
        return $this->hasMany(Promotionevents::class, "promotions_id");
    }

    public function promotioncoursesincluded()
    {
        return $this->belongsToMany(Courses::class, 'promotioncourses','promotions_id','courses_id');
    }

    public function promotioneventsincluded()
    {
        return $this->belongsToMany(Events::class, 'promotionevents','promotions_id','events_id');
    }



    public function promotionusers()
    {
        return $this->hasMany(Promotionusers::class, "promotions_id");
    }
    protected $fillable = [
        'title', 'description', 'type', 'value_for_egp', 'value_for_other_currencies', 'code', 'start_date', 'expiration_date', 'active', 'promotion_limit', 'promotion_usage', 'publish_as_notification', 'notification_message', 'include_courses', 'affiliate', 'affiliate_perc',
    ];

    public static function usedPromo($promoRow){


        $usedPromo = Promotionusers::where('user_id', Auth::user()->id)->where('promotions_id', $promoRow->id)->where('used', 1)->first();
        if($usedPromo){
            return true;
        }else{
            return false;
        }

    }


    public static function isValid($promoRow){
        if($promoRow->active == 1 && strtotime($promoRow->expiration_date) > time() && strtotime($promoRow->start_date) <= time() && $promoRow->promotion_limit > $promoRow->promotion_usage){
            return TRUE;
        }
        return FALSE;
    }
    public static function isValidB2c($promoRow){

        if($promoRow->active == 1 && strtotime($promoRow->expiration_date) > time() && strtotime($promoRow->start_date) <= time() && $promoRow->promotion_limit > $promoRow->promotion_usage && !self::usedPromo($promoRow) && ($promoRow->type == Promotions::TYPE_B2C_FIXED || $promoRow->type == Promotions::TYPE_B2C_PERCENT)){

            return true;

        }else{

            return false;
        }
    }



    public static function generatePromo($length = 5){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //Check if Code Unique

        $code = Promotions::where('code', $randomString)->exists();

        if ($code) {
            return self::generatePromo();
        }
        return $randomString;
    }

    public static function generatePromotion($title , $type ,$value_for_egp ,$value_for_other_currencies
        ,$expiration_date ){

        $promotion = new Promotions();
        $promotion->title = $title;
        $promotion->type = $type;
        $promotion->value_for_egp = $value_for_egp;
        $promotion->value_for_other_currencies = $value_for_other_currencies;
        $promotion->code = self::generatePromo();
        $promotion->start_date = now();
        $promotion->expiration_date = $expiration_date;
        $promotion->active = 1;
        $promotion->promotion_limit = 1;
        $promotion->include_courses = 0;
        if ($promotion->save()){
            return    $promotion->code;
        }

        return  false;
    }



}
