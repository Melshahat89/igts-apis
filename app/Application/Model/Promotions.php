<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    public $table = "promotions";
    public function promotionactive()
    {
        return $this->hasMany(Promotionactive::class, "promotions_id");
    }
    public function promotioncourses()
    {
        return $this->hasMany(Promotioncourses::class, "promotions_id");
    }

    public function promotionevents()
    {
        return $this->hasMany(Promotionevents::class, "promotions_id");
    }

    public function promotioncoursesincluded()
    {
        return $this->belongsToMany(Courses::class, 'promotioncourses','promotions_id','courses_id');
    }

    public function promotioneventsincluded()
    {
        return $this->belongsToMany(Events::class, 'promotionevents','promotions_id','events_id');
    }



    public function promotionusers()
    {
        return $this->hasMany(Promotionusers::class, "promotions_id");
    }
    protected $fillable = [
        'title', 'description', 'type', 'value_for_egp', 'value_for_other_currencies', 'code', 'start_date', 'expiration_date', 'active', 'promotion_limit', 'promotion_usage', 'publish_as_notification', 'notification_message', 'include_courses', 'affiliate', 'affiliate_perc',
    ];

    public static function isValid($promoRow){
      if($promoRow->active == 1 && strtotime($promoRow->expiration_date) > time() && strtotime($promoRow->start_date) <= time() && $promoRow->promotion_limit > $promoRow->promotion_usage){
          return TRUE;
      }
      return FALSE;
  }

}
