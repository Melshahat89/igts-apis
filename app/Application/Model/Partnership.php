<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{

  public $table = "partnership";


   protected $fillable = [
        'user_id',
        'certificates',
        'setting',
   ];


}
