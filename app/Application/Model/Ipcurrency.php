<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Ipcurrency extends Model
{

  public $table = "ipcurrency";


   protected $fillable = [
        'ip','type','continent','continent_code','country','country_code','country_flag','region','city','timezone','currency','currency_code','currency_rates'
   ];


}
