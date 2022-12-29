<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Eventsdata extends Model
{
   public $table = "eventsdata";
   public function eventstickets(){
		return $this->hasMany(Eventstickets::class, "eventsdata_id");
		}
   public function events(){
  return $this->hasMany(Events::class, "eventsdata_id");
  }
   public function manager(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
   'user_id',
        'name','email','logo','website','about','status','documentation', 'phone'
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
 public function getAboutLangAttribute(){
  return is_json($this->about) && is_object(json_decode($this->about)) ?  json_decode($this->about)->{app()->getLocale()}  : $this->about;
 }
 public function getAboutEnAttribute(){
  return is_json($this->about) && is_object(json_decode($this->about)) ?  json_decode($this->about)->en  : $this->about;
 }
 public function getAboutArAttribute(){
  return is_json($this->about) && is_object(json_decode($this->about)) ?  json_decode($this->about)->ar  : $this->about;
 }
 }
