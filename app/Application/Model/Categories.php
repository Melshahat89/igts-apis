<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Categories extends Model
{
   public $table = "categories";
   public function events(){
		return $this->hasMany(Events::class, "categories_id");
		}
   public function talks(){
  return $this->hasMany(Talks::class, "categories_id");
  }
   public function courses(){
  return $this->hasMany(Courses::class, "categories_id");
  }
     protected $fillable = [
        'name','slug','desc','parent_id','sort','status','show_home','show_menu','m_image','d_image','image'
       ,'color_code', 'end_time', 'enable_free', 'courses_id'
   ];
  public function getNameLangAttribute(){
  return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->{app()->getLocale()}  : $this->name;
 }
 public function getNameEnAttribute(){
  return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->en  : $this->name;
 }
 public function getNameArAttribute(){
  return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->ar  : $this->name;
 }
 public function getDescLangAttribute(){
  return is_json($this->desc) && is_object(json_decode($this->desc)) ?  json_decode($this->desc)->{app()->getLocale()}  : $this->desc;
 }
 public function getDescEnAttribute(){
  return is_json($this->desc) && is_object(json_decode($this->desc)) ?  json_decode($this->desc)->en  : $this->desc;
 }
 public function getDescArAttribute(){
  return is_json($this->desc) && is_object(json_decode($this->desc)) ?  json_decode($this->desc)->ar  : $this->desc;
 }
 }
