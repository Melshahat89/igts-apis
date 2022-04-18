<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Talksrelated extends Model
{
   public $table = "talksrelated";
   public function talks(){
		return $this->belongsTo(Talks::class, "talks_id");
		}
   public function relatedTalk(){
		return $this->belongsTo(Talks::class, "related_talk_id");
		}
     protected $fillable = [
   'talks_id',
   'related_talk_id',
        'position'
   ];
  }
