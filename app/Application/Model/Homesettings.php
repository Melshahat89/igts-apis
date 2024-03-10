<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Homesettings extends Model
{

  public $table = "homesettings";


   protected $fillable = [
        'bundles','featured_courses','events','talks','masters','courses_discount','bundle_discount','masters_discount','diplomas_discount', 'seo_title', 'seo_desc', 'seo_keys'
   ];


   public function getSeotitleLangAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->{app()->getLocale()} : $this->seo_title;
   }
   public function getSeotitleEnAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->en : $this->seo_title;
   }
   public function getSeotitleArAttribute()
   {
       return is_json($this->seo_title) && is_object(json_decode($this->seo_title)) ? json_decode($this->seo_title)->ar : $this->seo_title;
   }
   
   public function getSeodescLangAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->{app()->getLocale()} : $this->seo_desc;
   }
   public function getSeodescEnAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->en : $this->seo_desc;
   }
   public function getSeodescArAttribute()
   {
       return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->ar : $this->seo_desc;
   }
   public function getSeo_keysLangAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->{app()->getLocale()} : $this->seo_keys;
   }
   public function getSeo_keysEnAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->en : $this->seo_keys;
   }
   public function getSeo_keysArAttribute()
   {
       return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->ar : $this->seo_keys;
   }



    public function getYearlyB2cSubscriptionPriceAttribute(){

        $currency = getCurrency();

//        $price = round(($this->subscription_yearly * 12) * Payments::exchangeRate());

        if ($currency == "EGP"){
            $price = $this->subscription_yearly_egp;
        }else{
            $price = Currencies::getAmountcentsByCurrencyID('USD' , $currency, $this->subscription_yearly);
        }



        $promoCode = getCurrentPromoCode(null, Promotionactive::TYPE_B2C);

//        if($currency->b2c_yearly_discount_perc){
//            // $price = round($price - (($price * $currency->b2c_yearly_discount_perc) / 100));
//            $price = round($price - $currency->b2c_yearly_discount_perc); // Fixed Discount
//        }

        if ($promoCode) {
            //Check the promo again

            $promoRow = $promoCode->promotions;

            if ($promoRow && Promotions::isValidB2c($promoRow, $this->id)) {

                $discountType = $promoRow->type;
                $discountValue = ($currency == "EGP") ? $promoRow->value_for_egp : $promoRow->value_for_other_currencies;
                if ($discountType == Promotions::TYPE_B2C_PERCENT) {
                    $discountPrice = $discountValue * $price / 100;
                    $price = $price - $discountPrice;

                } else {
                    $discountPrice = $discountValue;
                    $price = $price - $discountPrice;

                }
            }
        }
        return $price;

    }

    public function getMonthlyB2cSubscriptionPriceAttribute(){

        $currency = getCurrency();
//        $price = round($this->subscription_monthly * Payments::exchangeRate());
        if ($currency == "EGP"){
            $price = $this->subscription_monthly_egp;
        }else{
            $price = Currencies::getAmountcentsByCurrencyID('USD' , $currency, $this->subscription_monthly);
        }

//        $promoCode = getCurrentPromoCode(null, Promotionactive::TYPE_B2C);
//
//        if ($promoCode) {
//            //Check the promo again
//
//            $promoRow = $promoCode->promotions;
//
//            if ($promoRow && Promotions::isValidB2c($promoRow, $this->id)) {
//
//                $discountType = $promoRow->type;
//                $discountValue = ($currency == "EGP") ? $promoRow->value_for_egp : $promoRow->value_for_other_currencies;
//                if ($discountType == Promotions::TYPE_B2C_PERCENT) {
//                    $discountPrice = $discountValue * $price / 100;
//                    $price = $price - $discountPrice;
//
//                } else {
//                    $discountPrice = $discountValue;
//                    $price = $price - $discountPrice;
//
//                }
//            }
//        }
//

        return $price;

    }

}
