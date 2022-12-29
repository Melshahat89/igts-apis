<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Coursesections extends Model
{
   public $table = "coursesections";
   public function quiz(){
		return $this->hasMany(Quiz::class, "coursesections_id");
		}
   public function courselectures(){
      return $this->hasMany(Courselectures::class, "coursesections_id")->orderBy('position', 'ASC');
   }
   public function courses(){
  return $this->belongsTo(Courses::class, "courses_id");
  }
     protected $fillable = [
   'courses_id',
        'title','will_do_at_the_end','position'
   ];
  public function getTitleLangAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{app()->getLocale()}  : $this->title;
 }
 public function getTitleEnAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
 }
 public function getTitleArAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
 }
 public function getWill_do_at_the_endLangAttribute(){
  return is_json($this->will_do_at_the_end) && is_object(json_decode($this->will_do_at_the_end)) ?  json_decode($this->will_do_at_the_end)->{app()->getLocale()}  : $this->will_do_at_the_end;
 }
 public function getWill_do_at_the_endEnAttribute(){
  return is_json($this->will_do_at_the_end) && is_object(json_decode($this->will_do_at_the_end)) ?  json_decode($this->will_do_at_the_end)->en  : $this->will_do_at_the_end;
 }
 public function getWill_do_at_the_endArAttribute(){
  return is_json($this->will_do_at_the_end) && is_object(json_decode($this->will_do_at_the_end)) ?  json_decode($this->will_do_at_the_end)->ar  : $this->will_do_at_the_end;
 }


 public function getHoursLecturesAttribute(){
   return gmdate("H:i:s", ($this->courselectures->sum('length'))) ;
}


 }
