<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class PageRate extends Model
{
   public $table = "pagerate";
   public function user(){
		return $this->belongsTo(User::class, "user_id");
		}
  public function page(){
  return $this->belongsTo(Page::class, "page_id");
  }
     protected $fillable = [
        '','user_id','page_id','rate'
   ];
  }
