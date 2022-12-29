<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
 class Transactions extends Model
{
   public $table = "transactions";
   public function events(){
		return $this->belongsTo(Events::class, "events_id");
		}
    const AFFILIATE1      = 1;
   const AFFILIATE2      = 2;
   const INSTRUCTOR      = 3;
   const AFFILIATE3      = 4;
   const AFFILIATE4      = 5;
   const EVENTDATA      = 6;
    public function courses(){
  return $this->belongsTo(Courses::class, "courses_id");
  }
   public function payments(){
  return $this->belongsTo(Payments::class, "payments_id");
  }
   public function user(){
  return $this->belongsTo(User::class, "user_id");
  }
     protected $fillable = [
     'events_id',
     'courses_id',
     'payments_id',
     'user_id',
        'price','currency','percent','amount','type','date'
   ];
     public static function getSumTransactions($course_id,$user_id,$type, $date=null) {

       $from = date('Y-m-01', strtotime($date));
       $to = date('Y-m-t', strtotime($date));

       if(isset($date)){

        $Transactions =Transactions::where('courses_id',$course_id)->where('user_id',$user_id)->where('type',$type)->whereBetween('date', [$from, $to])->sum('amount');
       
      }else{

        $Transactions =Transactions::where('courses_id',$course_id)->where('user_id',$user_id)->where('type',$type)->sum('amount');
       
      }
       
       return $Transactions;
   }
   }
