<?php
namespace App\Application\Model;
use Illuminate\Database\Eloquent\Model;
class Businessgroups extends Model
{
    public $table = "businessgroups";
    public function businessgroupsusers(){
//		return $this->hasMany(Businessgroupsusers::class, "businessgroups_id");


        return $this->belongsToMany(User::class, "businessgroupsusers", "businessgroups_id", "user_id");

    }
//   public function businessgroupsusersrows(){
//		return $this->hasMany(Businessgroupsusers::class, "businessgroups_id");
//		}
    public function businessdata(){
        return $this->belongsTo(Businessdata::class, "businessdata_id");
    }

    // public function businessgroupscourses(){
    //   return $this->belongsToMany(Courses::class, "businessgroupscourses", "businessgroups_id", "businesscourses_id");
    //   }

    public function businessgroupscourses(){
        return $this->belongsToMany(Courses::class, "businessgroupscourses", "businessgroups_id", "businesscourses_id");
    }

    public function businessgroupscoursesrows(){
        return $this->hasMany(Businessgroupscourses::class, "businessgroups_id");
    }
    // public function businessgroupcourses($businessID){
    //   return $this->belongsToMany(Businesscourses::class, "group_id")->where('businessdata_id', $businessID);
    // }
    public function parent(){
        return $this->belongsTo(Businessgroups::class, "parent_id");
    }
    protected $fillable = [
        'businessdata_id',
        'name','parent_id','user_id'
    ];
}
