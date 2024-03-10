<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;


class Currencies extends Model
{

    public $table = "currencies";
    CONST DEFUALT_CURRENCY = 'AED';


    protected $fillable = [
        'currency_code','country_id','discount_perc','exchangeratetoegp','exchangeratetoaed','exchangeratetousd','b2c_monthly_discount_perc','b2c_yearly_discount_perc','exchangeratetoasd'
    ];


    static function getCurrencyCodeByID($ID){
        return Currencies::where('id',$ID)->first()->currency_code;
    }

    static function getAmountcentsByCurrencyID($from,$to,$amount){
        $Currency = Currencies::where('currency_code',$from)->first();
        switch($to) {
            case('EGP'):
                $amount_cents = round( $amount * $Currency->exchangeratetoegp);
                break;

            case('AED'):
                $amount_cents = round( $amount * $Currency->exchangeratetoaed);
                break;

            case('USD'):
                $amount_cents = round( $amount * $Currency->exchangeratetousd);
                break;
            case('SAR'):
                $amount_cents = round( $amount * $Currency->exchangeratetoasd);
                break;

            default:
                $amount_cents = round( $amount * $Currency->exchangeratetousd);
        }
        return $amount_cents;
    }


}
