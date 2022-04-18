<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Careersresponses extends Model
{
   public $table = "careersresponses";
   public function careers(){
		return $this->belongsTo(Careers::class, "careers_id");
		}
     protected $fillable = [
   'careers_id',
        'name','email','mobile','file'
   ];
  }
