<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Businessinputfields extends Model
{

     use SoftDeletes;
   public $table = "businessinputfields";
   
     public function businessdata(){
	     return $this->belongsTo(Businessdata::class, "businessdata_id");
     }

     public function businessinputfieldsresponses(){
          return $this->hasMany(businessinputfieldsresponses::class, "businessinputfields_id");
     }

     protected $fillable = [
   'businessdata_id',
        'mandatory','field_name'
   ];
  }
