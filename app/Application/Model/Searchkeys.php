<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Searchkeys extends Model
{
   public $table = "searchkeys";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
     protected $fillable = [
   'user_id',
        'word','ip','country','city'
   ];
  }
