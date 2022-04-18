<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Businessdomains extends Model
{
   public $table = "businessdomains";
   public function businessdata(){
		return $this->belongsTo(Businessdata::class, "businessdata_id");
		}
     protected $fillable = [
   'businessdata_id',
        'domainname','status', 'token'
   ];
  }
