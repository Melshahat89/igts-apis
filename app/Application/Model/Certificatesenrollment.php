<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Certificatesenrollment extends Model
{
   public $table = "certificatesenrollment";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
        }
        public function certificate(){
            return $this->belongsTo(Certificates::class, "certificate_id");
            }
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'courses_id',
      'user_id',
        'certificate_id',
        'updated_at',
        'created_at'
   ];
  }
