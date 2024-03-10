<?php
namespace App\Application\Model;
use Illuminate\Database\Eloquent\Model;
class Courseenrollment extends Model
{
    public $table = "courseenrollment";
    const TYPE_B2B = "B2B";
    const TYPE_B2C = "B2C";

    public function subscriptionuser(){
        return $this->belongsTo(Subscriptionuser::class, "subscriptionuser_id");
    }


    public function courses(){
        return $this->belongsTo(Courses::class, "courses_id");
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    protected $fillable = [
        'subscriptionuser_id',
        'courses_id',
        'user_id',
        'start_time','end_time','status', 'orders_id','type','businessdata_id'
    ];
}
