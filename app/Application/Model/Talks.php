<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
   class Talks extends Model
{

    
   public $table = "talks";
   public function talklikes(){
		return $this->hasMany(Talklikes::class, "talks_id");
		}
   public function talksrelated(){
  return $this->hasMany(Talksrelated::class, "talks_id");
  }
   public function talksreviews(){
  return $this->hasMany(Talksreviews::class, "talks_id");
  }
   public function categories(){
  return $this->belongsTo(Categories::class, "categories_id");
  }
     public function instructor(){
         return $this->belongsTo(User::class, "instructor_id");
     }
        protected $fillable = [
   'categories_id',
        'title','slug','subtitle','description','language_id','length','featured','published','visits','video_file','sort','doctor_name','seo_desc','seo_keys','search_keys','image','promoPoster','cover',
         'instructor_id'
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
 public function getSubtitleLangAttribute(){
  return is_json($this->subtitle) && is_object(json_decode($this->subtitle)) ?  json_decode($this->subtitle)->{getCurrentLang()}  : $this->subtitle;
 }
 public function getSubtitleEnAttribute(){
  return is_json($this->subtitle) && is_object(json_decode($this->subtitle)) ?  json_decode($this->subtitle)->en  : $this->subtitle;
 }
 public function getSubtitleArAttribute(){
  return is_json($this->subtitle) && is_object(json_decode($this->subtitle)) ?  json_decode($this->subtitle)->ar  : $this->subtitle;
 }
 public function getDescriptionLangAttribute(){
  return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->{getCurrentLang()}  : $this->description;
 }
 public function getDescriptionEnAttribute(){
  return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->en  : $this->description;
 }
 public function getDescriptionArAttribute(){
  return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->ar  : $this->description;
 }
 public function getDoctor_nameLangAttribute(){
  return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ?  json_decode($this->doctor_name)->{getCurrentLang()}  : $this->doctor_name;
 }
 public function getDoctor_nameEnAttribute(){
  return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ?  json_decode($this->doctor_name)->en  : $this->doctor_name;
 }
 public function getDoctor_nameArAttribute(){
  return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ?  json_decode($this->doctor_name)->ar  : $this->doctor_name;
 }
 public function getSeo_descLangAttribute(){
  return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->{getCurrentLang()}  : $this->seo_desc;
 }
 public function getSeo_descEnAttribute(){
  return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->en  : $this->seo_desc;
 }
 public function getSeo_descArAttribute(){
  return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ?  json_decode($this->seo_desc)->ar  : $this->seo_desc;
 }
 public function getSeo_keysLangAttribute(){
  return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->{getCurrentLang()}  : $this->seo_keys;
 }
 public function getSeo_keysEnAttribute(){
  return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->en  : $this->seo_keys;
 }
 public function getSeo_keysArAttribute(){
  return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ?  json_decode($this->seo_keys)->ar  : $this->seo_keys;
 }



   public function getTalkRatingAttribute()
 {
     return $this->talksreviews->count() ? $this->talksreviews->sum('rating') / $this->talksreviews->count() : 0;
 }
  public function getTalkSumRatingAttribute()
 {
     return $this->talksreviews->sum('rating');
 }
 public function getTalkCountRatingAttribute()
 {
     return $this->talksreviews->count();
 }
   public function getRatingAttribute()
 {
     $fullRating = ($this->TalkCountRating) ? $this->TalkSumRating / $this->TalkCountRating : 0;
     $rate = ($fullRating > 0) ? round($fullRating, 1) : '<br>';
     if ($fullRating) {
         for ($i = 1; $i <= round($fullRating, 1); $i++) {
             $rate .= " <i class='star-rating checked'></i> ";
         }
         $notChecked = 5 - (int) $fullRating;
          for ($i = 1; $i <= $notChecked; $i++) {
             $rate .= " <i class='star-rating'></i> ";
         }
         $rate .= " (" . round($this->TalkCountRating, 1) . ")</span>";
     }
      return $rate;
 }
  public function getTalkRatingDetailsAttribute()
 {
      $ratingDetails = DB::table('talksreviews')
         ->select('rating', DB::raw('COUNT(rating) as ratingCount'))
         ->groupBy('rating')
         ->where('talks_id',$this->id)
         ->get();
      $count = 0;
     foreach ($ratingDetails as $item) {
         $count = $count + $item->ratingCount;
     }
     return array("ratingDetails" => $ratingDetails, "count" => $count);
 }


 public function getTalkCountLikeAttribute()
 {
     return $this->talklikes->where('status',1)->count();
 }
 public function getTalkCountDislikeAttribute()
 {
     return $this->talklikes->where('status',0)->count();
 }
 public function getUserTalklikeAttribute($userId=null)
 {
    if(!Auth::check()){
        return false;
    }   
        $userId = ($userId) ? $userId : Auth::user()->id;
        return $this->talklikes->where('user_id',$userId)->first();
 }



  }