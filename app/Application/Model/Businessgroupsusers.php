<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Businessgroupsusers extends Model
{
   public $table = "businessgroupsusers";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
   public function businessgroups(){
  return $this->belongsTo(Businessgroups::class, "businessgroups_id");
  }
     protected $fillable = [
     'user_id',
   'businessgroups_id',
        'status','note'
   ];
  }
