<?php
namespace App\Application\Model;
use Illuminate\Database\Eloquent\Model;
class Orders extends Model
{
    public $table = "orders";
    public function subscriptionuser(){
        return $this->hasMany(Subscriptionuser::class, "orders_id");
    }
    public function payments()
    {
        return $this->belongsTo(Payments::class, "payments_id");
    }
    public function employee(){
        return $this->belongsTo(User::class, 'emp_id');
    }
    const STATUS_FAILED = 0;
    const STATUS_PENDING = 1;
    const STATUS_SUCCEEDED = 2;
    const STATUS_DIRECTBUY = 3;
    const STATUS_KIOSK = 4;
    const STATUS_VODAFONE = 5;
    const STATUS_FAWRY = 6;
    const STATUS_MOBILEWALLET = 7;
    const STATUS_OFFLINE_DIRECTPAY = 8;
    const STATUS_CONSULTATION = 9;
    const STATUS_ROLLED_BACK = 10;
    const TYPE_ONLINE = 1;
    const TYPE_OFFLINE = 2;
    const TYPE_B2B = 3;
    const TYPE_B2C = 4;
    const SUBSCRIPTON_MONTHLY = 1;
    const SUBSCRIPTION_ANNUAL = 2;
    const METHOD_PAYMOB = 1;
    const METHOD_FAWRY = 2;
    //    const STATUS_FAILED = 0;
//    const STATUS_PENDING = 1;
//    const STATUS_SUCCEEDED = 2;
//    const STATUS_DIRECTBUY = 3;
//    const STATUS_KIOSK_PENDING = 4;
//    const STATUS_VODAFONE_PENDING = 5;
//    const STATUS_VODAFONE_DONE = 6;
//    const STATUS_FAWRY_PENDING = 7;
//    const STATUS_FAWRY_DONE = 8;
//    const STATUS_MOBILEWALLET_PENDING = 9;
//    const STATUS_MOBILEWALLET_DONE = 10;
//    const STATUS_KIOSK_DONE = 11;
//    const STATUS_VISA_MASTER_PENDING = 12;
    public function promotionusers()
    {
        return $this->hasMany(Promotionusers::class, "orders_id");
    }
    public function ordersposition()
    {
        return $this->hasMany(Ordersposition::class, "orders_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function consultationrequest(){
        return $this->belongsTo(Consultationsrequests::class, "consultationrequest_id");
    }
    protected $fillable = [
        'payments_id',
        'user_id',
        'status', 'comments', 'billing_address_id', 'accept_order_id', 'kiosk_id',
        'fawryRefNumber','accept_status', 'aff_id', 'aff_channel', 'is_free', 'exchange_rate', 'currency', 'consultationrequest_id'
    ];
    public function getorderAmountAttribute(){
        $amount = 0;
        foreach($this->ordersposition as $data){
            $amount += $data->amount;
        }
        return $amount;
    }
    public function getTotalOrderAmountAttribute(){
        return $this->ordersposition->sum('amount');
    }
}
