<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Lectures3d extends Model
{
   public $table = "lectures3d";
   public function courselectures(){
		return $this->belongsTo(Courselectures::class, "courselectures_id");
		}
     protected $fillable = [
   'courselectures_id',
        'title','link'
   ];
  }
