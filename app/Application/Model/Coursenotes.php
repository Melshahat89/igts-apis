<?php
namespace App\Application\Model;
use Illuminate\Database\Eloquent\Model;
class Coursenotes extends Model
{
    public $table = "coursenotes";

    public function courses(){
        return $this->belongsTo(Courses::class, "courses_id");
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    protected $fillable = [
        'courses_id',
        'user_id',
        'notes'
    ];
}
