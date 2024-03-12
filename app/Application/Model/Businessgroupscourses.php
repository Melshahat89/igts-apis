<?php
namespace App\Application\Model;
use Illuminate\Database\Eloquent\Model;
class Businessgroupscourses extends Model
{
    public $table = "businessgroupscourses";

    public function businesscourses(){
        return $this->belongsTo(Businesscourses::class, "businesscourses_id");
    }

    public function courses(){
        return $this->belongsTo(Courses::class, "businesscourses_id");
    }

    protected $fillable = [
        'businessgroups_id',
        'businesscourses_id',
    ];
}
