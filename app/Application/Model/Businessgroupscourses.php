<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class businessgroupscourses extends Model
{
   public $table = "businessgroupscourses";

   public function businesscourses(){
      return $this->belongsTo(Businesscourses::class, "businesscourses_id");
   }

     protected $fillable = [
   'businessgroups_id',
   'businesscourses_id',
   ];
  }
