<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Courseresources extends Model
{
   public $table = "courseresources";
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
		}
     protected $fillable = [
   'courses_id',
        'title','file'
   ];
  public function getTitleLangAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{getCurrentLang()}  : $this->title;
 }
 public function getTitleEnAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
 }
 public function getTitleArAttribute(){
  return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
 }
 }
