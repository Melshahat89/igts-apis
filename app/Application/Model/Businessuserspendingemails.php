<?php

namespace App\Application\Model;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Businessuserspendingemails extends Model
{

  use SoftDeletes;

  public $table = "businessuserspendingemails";


  protected $fillable = [
    'businessdata_id',
    'email',
  ];

  



}
