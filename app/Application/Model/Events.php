<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Events extends Model
{
    public $table = "events";
    public function transactions(){
		return $this->hasMany(Transactions::class, "events_id");
		}
    public function eventsenrollment(){
  return $this->hasMany(Eventsenrollment::class, "events_id");
  }
    public function ordersposition()
    {
        return $this->hasMany(Ordersposition::class, "events_id");
    }
    public function eventsreviews()
    {
        return $this->hasMany(Eventsreviews::class, "events_id");
    }
    const TYPE_LIVE = 1;
    const TYPE_RECORDED = 2;
    const TYPE_OFFLINE = 3;
    public function eventstickets()
    {
        return $this->hasMany(Eventstickets::class, "events_id");
    }
    public function eventsdata()
    {
        return $this->belongsTo(Eventsdata::class, "eventsdata_id");
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class, "categories_id");
    }
    protected $fillable = [
        'eventsdata_id',
        'categories_id',
        'title', 'description', 'image', 'is_free', 'price_egp', 'price_usd', 'type', 'status', 'location', 'live_link', 'recorded_link', 'visits', 'start_date', 'end_date','instructor_per'
    ];
    public function getTitleLangAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->{getCurrentLang()}  : $this->title;
    }
    public function getTitleEnAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->en  : $this->title;
    }
    public function getTitleArAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ?  json_decode($this->title)->ar  : $this->title;
    }
    public function getDescriptionLangAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->{getCurrentLang()}  : $this->description;
    }
    public function getDescriptionEnAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->en  : $this->description;
    }
    public function getDescriptionArAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ?  json_decode($this->description)->ar  : $this->description;
    }
    public function getEventRatingAttribute()
    {
        return $this->eventsreviews->count() ? $this->eventsreviews->sum('rating') / $this->eventsreviews->count() : 0;
    }
    public function getEventSumRatingAttribute()
    {
        return $this->eventsreviews->sum('rating');
    }
    public function getEventCountRatingAttribute()
    {
        return $this->eventsreviews->count();
    }
    public function getRatingAttribute()
    {
        $fullRating = ($this->EventCountRating) ? $this->EventSumRating / $this->EventCountRating : 0;
        $rate = ($fullRating > 0) ? round($fullRating, 1) : '<br>';
        if ($fullRating) {
            for ($i = 1; $i <= round($fullRating, 1); $i++) {
                $rate .= " <i class='star-rating checked'></i> ";
            }
            $notChecked = 5 - (int) $fullRating;
            for ($i = 1; $i <= $notChecked; $i++) {
                $rate .= " <i class='star-rating'></i> ";
            }
            $rate .= " (" . round($this->EventCountRating, 1) . ")</span>";
        }
        return $rate;
    }
    public function getEventRatingDetailsAttribute()
    {
        $ratingDetails = DB::table('eventsreviews')
            ->select('rating', DB::raw('COUNT(rating) as ratingCount'))
            ->groupBy('rating')
            ->where('events_id', $this->id)
            ->get();
        $count = 0;
        foreach ($ratingDetails as $item) {
            $count = $count + $item->ratingCount;
        }
        return array("ratingDetails" => $ratingDetails, "count" => $count);
    }
    public function getPriceTextAttribute()
    {
        $currency = getCurrency();
        if ($currency == "EGP") {
            $price = $this->price_egp;
        } else {
            $price = $this->price_usd;
        }
        return "<span class='price'>" . $currency . "
         " . number_format($price) . "</span>";
    }

    public function getOriginalPriceAttribute()
    {
        $currency = getCurrency();

        $promoEventIncluded = false;

        $promoCode = getCurrentPromoCode();
        
        if ($promoCode) {
            //Check the promo again
            $promoRow = $promoCode->promotions;
            if ($promoRow && Promotions::isValid($promoRow)) {

                $existPromoUser = Promotionusers::where('promotions_id', $promoRow->id)->where('user_id', Auth::user()->id)->first();

                if($existPromoUser && $existPromoUser->used == 0) {

                    $appliedEvents = $promoRow->promotionevents;

                    foreach ($appliedEvents as $appliedEvent) {
                        if($appliedEvent->events_id == $this->id) {
                            $promoEventIncluded = true;
                        break;
                        }
                    }

                }

                

            }
        }

        if ($currency == "EGP") {

            if($promoEventIncluded) {

                $price = ($promoRow->type == 0) ? $this->price_egp - $promoRow->value_for_egp : $this->price_egp - ($this->price_egp * $promoRow->value_for_egp / 100);

            } else {

                $price = $this->price_egp;
            }

        } else {
            

            if($promoEventIncluded) {

                $price = ($promoRow->type == 1) ? $this->price_usd - $promoRow->value_for_usd : $this->price_usd - ($this->price_usd * $promoRow->value_for_usd / 100);

            } else {

                $price = $this->price_usd;
            }

        }
        
        return $price ;
    }
     public static function isEnrolledEvent($id, $userId = null)
    {
        if (!Auth::check()) {
            return false;
        }
        $userId = ($userId) ? $userId : Auth::user()->id;
        $dateNow = date('Y-m-d H:i:s');
        $registeredEvent = Eventsenrollment::where('user_id', $userId)->where('events_id', $id)->whereDate('start_time', '<=', $dateNow)
            ->whereDate('end_time', '>=', $dateNow)
            ->where('status', 1)->first();
        return ($registeredEvent) ? true : false;
    }
    public static function inShoppingCart($id, $userId = null)
    {
        if (!Auth::check()) {
            return false;
        }
        $userId = ($userId) ? $userId : Auth::user()->id;
        $order = Orders::where('user_id', Auth::user()->id)->where('status', Orders::STATUS_PENDING)->orderBy('id', 'DESC')->first();
        if (!$order) {
            return false;
        }
        // Ceck if the order position found:
        $orderPosition = Ordersposition::where('events_id', $id)->where('orders_id', $order->id)->first();
        return ($orderPosition) ? true : false;
    }


    public static function generateCertificate($event, $name = "")
    {

        $title = $event->title_en;

        $randomNo = auth()->user()->id . "R1" . createRandomCode();
        $fileName = 'MEDUO-EVENT-CRT-' . $randomNo;



        $viewhtml = View::make('website.certificates.igtsCert', array('course' => $event, 'name' => $name))->render();
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('mode', 'utf-8');
        $options->set('defaultFont', 'Helvetica');

        // $options->setIsRemoteEnabled(true);
        $options->setDpi(100);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsJavascriptEnabled(true);
        $options->setIsPhpEnabled(true);

        $mpdf = new \Dompdf\Dompdf($options);
        $mpdf->set_paper('A4', 'landscape');
//        $mpdf->setBasePath(get_template_directory() . '/style.css');
        $mpdf->loadHTML($viewhtml);
        $mpdf->render();
        // $mpdf->stream();

        $content = $mpdf->output();

        $image = $content;
        file_put_contents(public_path(env('UPLOAD_PATH_1')) . '/certificate/' . $fileName . '.pdf', $image);

        // $image = base64_decode($content);
        // file_put_contents(public_path(env('UPLOAD_PATH_1')) . '/certificate/' . $fileName . '.jpg', $image);

        $eventEnrollment = Eventsenrollment::where('user_id', Auth::user()->id)->where('events_id', $event->id)->get();
        
        $eventEnrollment[0]->certificate = $fileName . '.pdf';
        $eventEnrollment[0]->save();
            
        return $eventEnrollment[0]->certificate;



    }

    public static function hasEventCertificate($id)
    {

        $eventEnrollment = Eventsenrollment::where('user_id', Auth::user()->id)->where('events_id', $id)->get();

        return ($eventEnrollment[0]->certificate) ? true : false;

    }

    public static function recordVisit($event){

        $event->visits++;
        $event->save();

    }


}
