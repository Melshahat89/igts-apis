<?php

namespace App\Application\Model;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Businessdata extends Model
{
  public $table = "businessdata";
  public function businesscourses()
  {
    return $this->hasMany(Businesscourses::class, "businessdata_id");
  }
  
  public function businesscoursescourses(){
    return $this->belongsToMany(Courses::class, 'businesscourses', 'businessdata_id', 'courses_id');
  }
  const TYPE_PERCENTAGE = 1;
  const TYPE_VALUE = 2;
  public function businessgroups()
  {
    return $this->hasMany(Businessgroups::class, "businessdata_id");
  }
  public function mystudents()
  {
    return $this->hasMany(User::class, "businessdata_id");
  }
  public function businessdomains()
  {
    return $this->hasMany(Businessdomains::class, "businessdata_id");
  }
  public function manager()
  {
    return $this->belongsTo(User::class, "user_id");
  }

  public function businessinputfields() {
    return $this->hasMany(Businessinputfields::class, "businessdata_id");
  }

  protected $fillable = [
    'user_id',
    'name', 'discount_type', 'discount_value', 'automatically_license', 'logo', 'status', 'licenses', 'discount_value_dollar','start_time','end_time','banner',
  ];
  public function getNameLangAttribute()
  {
    return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->{app()->getLocale()}  : $this->name;
  }
  public function getNameEnAttribute()
  {
    return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->en  : $this->name;
  }
  public function getNameArAttribute()
  {
    return is_json($this->name) && is_object(json_decode($this->name)) ?  json_decode($this->name)->ar  : $this->name;
  }
  public function getCoutUsersAttribute()
  {
    return $this->mystudents->count();
  }
  public function getCoutEnrollmentsAttribute()
  {
    return Courseenrollment::whereHas('user', function ($query) {
      return $query->where('businessdata_id', '=', $this->id);
    })
      ->count();
  }
  public function getCountUsersEnrollmentedAttribute()
  {
    $count = Courseenrollment::select(DB::raw('Count(user_id) as Count'), 'user_id')
      ->with('user')
      ->whereHas('user', function ($query) {
        return $query->where('businessdata_id', '=', $this->id);
      })
      ->groupBy('user_id')
      ->get();
    return count($count);
  }

  public function getCountUsersCertificatesAttribute() {
    $businessUsers = $this->mystudents;

    $count = 0;
    foreach($businessUsers as $businessUser) {

      $count += count($businessUser->certificates);

    }

    return $count;

  }

  public function getCountUsersPassedExamsAttribute() {

    $businessUsers = $this->mystudents;

    $count = 0;
    foreach($businessUsers as $businessUser) {

      $count += count($businessUser->passedexams);

    }


    return $count;

  }
  
  public function getActiveUsersAttribute()
  {
    //return $this->mystudents->where('activatxed', 1)->count();
    $this->mystudents[0]->progress;

    $date = new DateTime();
    $to = $date->format('Y-m-d H:i:s');
    $from = $date->modify("-3 month")->format('Y-m-d H:i:s');

    $businessUsersCount = count($this->mystudents);

    //Business users count with progress for the last 3 months period
    $activeUsersCount = count(Progress::select('user_id')->whereIn('user_id', User::select('id')->where('businessdata_id', $this->id))->distinct('user_id')->whereBetween('created_at', [$from, $to])->get());

    return ($activeUsersCount / $businessUsersCount) * 100;
  }    
  public function getInActiveUsersAttribute()
  {
    return $this->mystudents->where('activated', 0)->count();
  }

}
