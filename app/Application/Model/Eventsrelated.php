<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Eventsrelated extends Model
{
   public $table = "coursesrelatedevents";
   
   public function courses(){
		return $this->belongsTo(Courses::class, "courses_id");
    
    }
    public function includedEvent(){
        return $this->belongsTo(Events::class, "included_event");
    }
     protected $fillable = [
   'courses_id',
   'included_event',
   ];
  }
