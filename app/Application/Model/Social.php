<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{

  public $table = "social";

  public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

   protected $fillable = [
        'user_id','provider','identifier','profile_cache','session_data','token'
   ];


}
