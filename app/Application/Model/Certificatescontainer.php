<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Certificatescontainer extends Model
{
   public $table = "certificatescontainer";
   public function certificate(){
     return $this->belongsTo(Certificates::class, "certificate_id")->where('visible', 1);
     }
     public function certificateall(){
      return $this->belongsTo(Certificates::class, "certificate_id");
      }
     public function courses(){
     return $this->belongsTo(Courses::class, "courses_id");
     }
     protected $fillable = [
   'courses_id',
   'certificate_id',
   ];

   public function getTitleWithCourseAttribute(){

    return ($this->certificateall && $this->courses) ? $this->certificateall->title_lang . ' - ' . $this->courses->title_lang : null;
  }

}
