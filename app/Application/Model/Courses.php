<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

 class Courses extends Model
{
    public $table = "courses";
    public function progress(){
		return $this->hasMany(Progress::class, "courses_id");
		}
    public function businesscourses()
    {
        return $this->hasMany(Businesscourses::class, "courses_id");
    }
    const TYPE_COURSE = 1;
    const TYPE_DIPLOMAS = 2;
    const TYPE_MASTERS = 3;
    const TYPE_BUNDLES = 4;
    //const TYPE_TERM = 5;  
    const TYPE_WEBINAR = 5;
    const FULL_TIME_ACCESS = 1;
    const NOT_FULL_TIME_ACCESS = 0;
    public function masterrequest()
    {
        return $this->hasMany(Masterrequest::class, "courses_id");
    }

    public function businesscourseenrollments(){
       // return $this->belongsToMany(Courses::class, 'courseenrollment')->whereIn('user_id', Business);
    }
    public function quiz()
    {
        return $this->hasOne(Quiz::class, "courses_id");
    }
    public function transactions()
    {
        return $this->hasMany(Transactions::class, "courses_id");
    }
    public function courseincludes()
    {
        return $this->hasMany(Courseincludes::class, "courses_id")->orderBy('position', 'ASC');;
    }
     public function coursesincluded()
    {
        return $this->belongsToMany(Courses::class, 'courseincludes','courses_id','included_course');
    }
       public function promotioncourses()
    {
        return $this->hasMany(Promotioncourses::class, "courses_id");
    }
    public function ordersposition()
    {
        return $this->hasMany(Ordersposition::class, "courses_id");
    }
    public function courserelated()
    {
        return $this->hasMany(Courserelated::class, "courses_id")->take(7);
    }
    public function courserelatedsync(){
        return $this->belongsToMany(Courses::class, 'courserelated','courses_id','related_course_id');
    }
    
    public function courseresources()
    {
        return $this->hasMany(Courseresources::class, "courses_id")->orderBy('position', 'ASC');
    }
    public function courseenrollment()
    {
        return $this->hasMany(Courseenrollment::class, "courses_id");
    }

    public function coursesrelatedevents(){
        return $this->belongsToMany(Events::class, 'coursesrelatedevents', 'courses_id', 'included_event');
    }

    public function usercourseenrollment(){

        return Courseenrollment::where('courses_id', $this->id)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
    }
  

    public function activeCourseEnrollment()
    {
        $now = date('Y-m-d');
        return $this->hasMany(Courseenrollment::class, "courses_id")
            ->whereDate('start_time', '<=', $now)
            ->whereDate('end_time', '>=', $now)
            ->where('status', 1);
    }
    public function courselectures()
    {
        return $this->hasMany(Courselectures::class, "courses_id");
    }
    public function coursesections()
    {
        return $this->hasMany(Coursesections::class, "courses_id")->orderBy('position', 'ASC');
    }
    public function coursereviews()
    {
        return $this->hasMany(Coursereviews::class, "courses_id");
    }
    public function coursewishlist()
    {
        return $this->hasMany(Coursewishlist::class, "courses_id");
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class, "categories_id");
    }
    public function instructor()
    {
        return $this->belongsTo(User::class, "instructor_id");
    }

    public function certificatescontainer(){
        return $this->hasMany(Certificatescontainer::class, "courses_id")->whereHas('certificate');
    }

    public function dynamicfields(){
        return $this->hasMany(DynamicFields::class, "model_id")->where('model', 'courses');
    }



    protected $fillable = [
        'categories_id',
        'title', 'slug', 'description', 'welcome_message', 'congratulation_message', 'type', 'skill_level', 'language_id', 'has_captions', 'has_certificate', 'length', 'price', 'price_in_dollar', 'affiliate1_per', 'affiliate2_per', 'affiliate3_per', 'affiliate4_per', 'instructor_per', 'discount_egp', 'discount_usd', 'featured', 'image', 'promo_video', 'visits', 'published', 'position', 'sort', 'doctor_name', 'full_access', 'access_time', 'soon', 'seo_desc', 'seo_keys', 'search_keys', 'poster',
        'promoPoster', 'instructor_id',
        'will_learn', 'requirments', 'description_large', 'target_students', 'is_partnership',
        'other_categories','lectures_link','videosready','sales_count','start_date', 'certificates', 'accreditation_text', 'vdocipher_tag', 'webinar_url',
    ];
         public function getTitleLangAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->{app()->getLocale()} : $this->title;
    }
    public function getTitleEnAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->en : $this->title;
    }
    public function getTitleArAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->ar : $this->title;
    }
    public function getDescriptionLangAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->{app()->getLocale()} : $this->description;
    }
    public function getDescriptionEnAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->en : $this->description;
    }
    public function getDescriptionArAttribute()
    {
        return is_json($this->description) && is_object(json_decode($this->description)) ? json_decode($this->description)->ar : $this->description;
    }
    public function getWelcome_messageLangAttribute()
    {
        return is_json($this->welcome_message) && is_object(json_decode($this->welcome_message)) ? json_decode($this->welcome_message)->{app()->getLocale()} : $this->welcome_message;
    }
    public function getWelcome_messageEnAttribute()
    {
        return is_json($this->welcome_message) && is_object(json_decode($this->welcome_message)) ? json_decode($this->welcome_message)->en : $this->welcome_message;
    }
    public function getWelcome_messageArAttribute()
    {
        return is_json($this->welcome_message) && is_object(json_decode($this->welcome_message)) ? json_decode($this->welcome_message)->ar : $this->welcome_message;
    }
    public function getCongratulation_messageLangAttribute()
    {
        return is_json($this->congratulation_message) && is_object(json_decode($this->congratulation_message)) ? json_decode($this->congratulation_message)->{app()->getLocale()} : $this->congratulation_message;
    }
    public function getCongratulation_messageEnAttribute()
    {
        return is_json($this->congratulation_message) && is_object(json_decode($this->congratulation_message)) ? json_decode($this->congratulation_message)->en : $this->congratulation_message;
    }
    public function getCongratulation_messageArAttribute()
    {
        return is_json($this->congratulation_message) && is_object(json_decode($this->congratulation_message)) ? json_decode($this->congratulation_message)->ar : $this->congratulation_message;
    }
    public function getDoctornameLangAttribute()
    {
        return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ? json_decode($this->doctor_name)->{app()->getLocale()} : $this->doctor_name;
    }
    public function getDoctornameEnAttribute()
    {
        return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ? json_decode($this->doctor_name)->en : $this->doctor_name;
    }
    public function getDoctornameArAttribute()
    {
        return is_json($this->doctor_name) && is_object(json_decode($this->doctor_name)) ? json_decode($this->doctor_name)->ar : $this->doctor_name;
    }
    public function getSeodescLangAttribute()
    {
        return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->{app()->getLocale()} : $this->seo_desc;
    }
    public function getSeodescEnAttribute()
    {
        return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->en : $this->seo_desc;
    }
    public function getSeodescArAttribute()
    {
        return is_json($this->seo_desc) && is_object(json_decode($this->seo_desc)) ? json_decode($this->seo_desc)->ar : $this->seo_desc;
    }
    public function getSeokeysLangAttribute()
    {
        return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->{app()->getLocale()} : $this->seo_keys;
    }
    public function getSeo_keysEnAttribute()
    {
        return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->en : $this->seo_keys;
    }
    public function getSeo_keysArAttribute()
    {
        return is_json($this->seo_keys) && is_object(json_decode($this->seo_keys)) ? json_decode($this->seo_keys)->ar : $this->seo_keys;
    }
    public function getSearchkeysLangAttribute()
    {
        return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ? json_decode($this->search_keys)->{app()->getLocale()} : $this->search_keys;
    }
    public function getSearch_keysEnAttribute()
    {
        return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ? json_decode($this->search_keys)->en : $this->search_keys;
    }
    public function getSearch_keysArAttribute()
    {
        return is_json($this->search_keys) && is_object(json_decode($this->search_keys)) ? json_decode($this->search_keys)->ar : $this->search_keys;
    }
    public function getwilllearnLangAttribute()
    {
        return is_json($this->will_learn) && is_object(json_decode($this->will_learn)) ? json_decode($this->will_learn)->{app()->getLocale()} : $this->will_learn;
    }
    public function getwilllearnEnAttribute()
    {
        return is_json($this->will_learn) && is_object(json_decode($this->will_learn)) ? json_decode($this->will_learn)->en : $this->will_learn;
    }
    public function getwilllearnArAttribute()
    {
        return is_json($this->will_learn) && is_object(json_decode($this->will_learn)) ? json_decode($this->will_learn)->ar : $this->will_learn;
    }
    public function getrequirmentsLangAttribute()
    {
        return is_json($this->requirments) && is_object(json_decode($this->requirments)) ? json_decode($this->requirments)->{app()->getLocale()} : $this->requirments;
    }
    public function getrequirmentsEnAttribute()
    {
        return is_json($this->requirments) && is_object(json_decode($this->requirments)) ? json_decode($this->requirments)->en : $this->requirments;
    }
    public function getrequirmentsArAttribute()
    {
        return is_json($this->requirments) && is_object(json_decode($this->requirments)) ? json_decode($this->requirments)->ar : $this->requirments;
    }
    public function getdescriptionlargeLangAttribute()
    {
        return is_json($this->description_large) && is_object(json_decode($this->description_large)) ? json_decode($this->description_large)->{app()->getLocale()} : $this->description_large;
    }
    public function getdescriptionlargeEnAttribute()
    {
        return is_json($this->description_large) && is_object(json_decode($this->description_large)) ? json_decode($this->description_large)->en : $this->description_large;
    }
    public function getdescriptionlargeArAttribute()
    {
        return is_json($this->description_large) && is_object(json_decode($this->description_large)) ? json_decode($this->description_large)->ar : $this->description_large;
    }

    public function getaccreditationtextLangAttribute()
    {
        return is_json($this->accreditation_text) && is_object(json_decode($this->accreditation_text)) ? json_decode($this->accreditation_text)->{app()->getLocale()} : $this->accreditation_text;
    }
    public function getaccreditationtextEnAttribute()
    {
        return is_json($this->accreditation_text) && is_object(json_decode($this->accreditation_text)) ? json_decode($this->accreditation_text)->en : $this->accreditation_text;
    }
    public function getaccreditationtextArAttribute()
    {
        return is_json($this->accreditation_text) && is_object(json_decode($this->accreditation_text)) ? json_decode($this->accreditation_text)->ar : $this->accreditation_text;
    }

    public function gettargetstudentsLangAttribute()
    {
        return is_json($this->target_students) && is_object(json_decode($this->target_students)) ? json_decode($this->target_students)->{app()->getLocale()} : $this->target_students;
    }
    public function gettargetstudentsEnAttribute()
    {
        return is_json($this->target_students) && is_object(json_decode($this->target_students)) ? json_decode($this->target_students)->en : $this->target_students;
    }
    public function gettargetstudentsArAttribute()
    {
        return is_json($this->target_students) && is_object(json_decode($this->target_students)) ? json_decode($this->target_students)->ar : $this->target_students;
    }
    public function getCourseRatingAttribute()
    {
        return $this->coursereviews->count() ? $this->coursereviews->sum('rating') / $this->coursereviews->count() : 0;
    }
    public function getCourseSumRatingAttribute()
    {
        return $this->coursereviews->sum('rating');
    }
    public function getCourseCountRatingAttribute()
    {
        return $this->coursereviews->count();
    }
    public function getCourseCountLecturesAttribute()
    {
        return $this->courselectures->count();
    }
    public function getCourseDurationAttribute()
    {
        return $this->courselectures->sum('length');
    }
    public function getMasterRequestApproveAttribute()
    {
        if (Auth::check()) {
            $Masterrequest = $this->hasMany(Masterrequest::class, "courses_id")->where('user_id', auth()->user()->id)->where('status', 1)->first();
            return is_null($Masterrequest) ? false : true;
        } else {
            return false;
        }
    }
    public function getPriceBaseAttribute()
    {
        // $country = userCountry();
        $currency = getCurrency();
        if ($currency == "EGP") {
            $price = $this->price;
            $discount = $this->discount_egp;
        } else {
            $price = $this->price_in_dollar;
            $discount = $this->discount_usd;
        }
        ////////////////////////////////////////////
        $priceAfterInternalDescount = $price - (($price * $discount) / 100);
        //chek promo discount
        $promoCode = getCurrentPromoCode();
        $discountPriceBusiness = 0;
        $promoPriceBusiness = 0;
        if ($promoCode) {
            //Check the promo again
            $promoRow = $promoCode->promotions;
            if ($promoRow && Promotions::isValid($promoRow)) {
                $discountValue = (getCurrency() == "EGP") ? $promoRow->value_for_egp : $promoRow->value_for_other_currencies;
                $discountType = $promoRow->type;
                $appliedCourses = $promoRow->Promotioncourses;
                // if seleced course, apply the discount on it.
                if ($appliedCourses) {
                    $promoCourses = $cartCourses = array();
                    foreach ($appliedCourses as $appliedCourse) {
                        $promoCourses[] = $appliedCourse->courses_id;
                    }
                    if (in_array($this->id, $promoCourses)) {
                        if ($discountType == 1) {
                            $discountPrice = $discountValue * $priceAfterInternalDescount / 100;
                            $promoPrice = $priceAfterInternalDescount - $discountPrice;
                        } else {
                            $discountPrice = $discountValue;
                            $promoPrice = $priceAfterInternalDescount - $discountPrice;
                        }
                    } else {
                        $promoPrice = $priceAfterInternalDescount;
                    }
                }
            } else {
                $promoPrice = $priceAfterInternalDescount;
            }
        } else {
            $promoPrice = $priceAfterInternalDescount;
        }
        //Check Promo Business
        if (auth()->check()) {
            if (auth()->user()->businessdata_id) {
                $businessdata = Businessdata::where('status', 1)->find(auth()->user()->businessdata_id);
                if ($businessdata) {
                     //Check if Course in business
                    $businessCourses = Businesscourses::where('courses_id', $this->id)->where('businessdata_id', $businessdata->id)->first();
                     if ($businessCourses) {
                        $discountValueBusiness = (getCurrency() == "EGP") ? (int) $businessdata->discount_value : (int) $businessdata->discount_value_dollar;
                        if ($businessdata->discount_type == Businessdata::TYPE_PERCENTAGE) {
                            $discountPriceBusiness = ($discountValueBusiness * $promoPrice / 100);
                            $promoPriceBusiness = ($promoPrice - $discountPriceBusiness);
                        } elseif ($businessdata->discount_type == Businessdata::TYPE_VALUE) {
                            $discountPriceBusiness = $discountValueBusiness;
                            $promoPriceBusiness = ($promoPrice - $discountPriceBusiness);
                        }
                        $promoPrice = $promoPriceBusiness;
                        $discount = $discount + $discountPriceBusiness;
                    }
                }
            }
        }
        return (['discount' => $discount, 'price' => round($price), 'currency' => $currency, 'promoPrice' => round($promoPrice)]);
    }
    public function getPriceTextAttribute()
    {
        $BasePrice = $this->getPriceBaseAttribute();
        $discount = $BasePrice['discount'];
        $price = $BasePrice['price'];
        $currency = $BasePrice['currency'];
        $promoPrice = $BasePrice['promoPrice'];
        ////////////////////////////////////////////
        if ($discount == 0) {
            if ($promoPrice == 0) {
                return "<div class=''>" .  trans('courses.Free') . "</span>";
            } else {
                return "<span class=''>" . $currency . "
                " . number_format($price) . "</span>";
            }
        }
        // $priceText = "<span class='before-discount'>" . $currency . "
        // " . number_format($price) . "</span>" . "<span class='price'>" . $currency . "
        //  " . number_format($promoPrice) . "</span>";
        if ($promoPrice == 0) {
            $priceText = "<del class='course_old_price p-2'>" . $currency . "
        " . number_format($price) . "</del>" . "<div class=''>"  . "
         " . trans('courses.Free')  . "</div>";
        } else {
            $priceText = "<del class='course_old_price p-2'>" . $currency . "
        " . number_format($price) . "</del>" . "<div class=''>" . $currency . "
         " . number_format($promoPrice) . "</div>";
        }
        return $priceText;
    }
    public function getBusinessPriceTextAttribute()
    {
        $BasePrice = $this->getPriceBaseAttribute();
        $discount = $BasePrice['discount'];
        $price = $BasePrice['price'];
        $currency = $BasePrice['currency'];
        $promoPrice = $BasePrice['promoPrice'];
        ////////////////////////////////////////////
        if ($discount == 0) {
            if ($promoPrice == 0) {
                return "<span class='price'>" .  trans('courses.Free') . "</span>";
            } else {
                return "<span class='price'>" . $currency . "
                " . number_format($price) . "</span>";
            }
        }

        if ($promoPrice == 0) {
            $priceText = "<span class='price'>" . trans('courses.Free')  . "</span>";
        } else {
            $priceText = "<span class='price'>" . $currency . " " . number_format($promoPrice) . "</span>";
        }
        return $priceText;
    }
     public function getBundleDiscountPriceTextAttribute()
    {
          $BasePrice = $this->getPriceBaseAttribute();
        $discount = Setting::where('id', 9)->get()[0]->body_setting;
        $price = $BasePrice['price'] - ($BasePrice['price'] * $discount / 100);
        $currency = $BasePrice['currency'];
        ////////////////////////////////////////////
                 // $priceText = "<span class='before-discount'>" . $currency . "
        // " . number_format($price) . "</span>" . "<span class='price'>" . $currency . "
        //  " . number_format($promoPrice) . "</span>";
                             $priceText = "<span class='before-discount'>" . $currency . "
        " . number_format($BasePrice['price']) . "</span>" . "<br> <span class='price'>" . $currency . "
         " . number_format($price) . "</span>";
                 return $priceText;
    }
     public function getPriceTextH1Attribute()
    {
        $BasePrice = $this->getPriceBaseAttribute();
        $discount = $BasePrice['discount'];
        $price = $BasePrice['price'];
        $currency = $BasePrice['currency'];
        $promoPrice = $BasePrice['promoPrice'];
        ////////////////////////////////////////////
        if ($discount == 0) {
            if ($promoPrice == 0) {
                return "<h1 class=\"price\">" . trans('courses.Free') . "</h1>";
            } else {
                return "<h1 class=\"price\">" . $currency . "" . number_format($price) . "</h1>";
            }
        }
        // $priceText = "<h1 class=\"price\">" . $currency . "" . number_format($promoPrice) . "</h1>
        //             <span class=\"before-discount\">" .
        // $currency . " " . number_format($price) . "</span>";
                   if ($promoPrice == 0) {
            $priceText = "<h1 class=\"price\">" .  trans('courses.Free'). "</h1>
            <span class=\"before-discount\">" . " " . number_format($price) . "</span>";
        } else {
            $priceText = "<h1 class=\"price\">" . $currency . "" . number_format($promoPrice) . "</h1>
            <span class=\"before-discount\">" .
                $currency . " " . number_format($price) . "</span>";
        }
        return $priceText;
    }
    public function getOriginalPriceAttribute()
    {
        $BasePrice = $this->getPriceBaseAttribute();
        $promoPrice = $BasePrice['promoPrice'];
        ////////////////////////////////////////////
        return $promoPrice;
    }
    public function getHoursLectures($minutes = NULL)
    {
        return ($minutes && $this->type == Courses::TYPE_BUNDLES) ? gmdate("H:i:s", ($minutes)) :  gmdate("H:i:s", ($this->courselectures->sum('length')));
    }
    public function getBundleHours(){
        $sum = 0;
        
        foreach($this->courseincludes as $includedCourse){

            $sum += $includedCourse->includedCourse->length;

        }

        return gmdate("H:i:s", ($sum*60));
    }

    public function getRatingAttribute()
    {
        $fullRating = ($this->CourseCountRating) ? $this->CourseSumRating / $this->CourseCountRating : 0;
        $rate = ($fullRating > 0) ? round($fullRating, 1) : '<br>';
        if ($fullRating) {
            for ($i = 1; $i <= round($fullRating, 1); $i++) {
                $rate .= " <i class='star-rating checked'></i> ";
            }
            $notChecked = 5 - (int) $fullRating;
            for ($i = 1; $i <= $notChecked; $i++) {
                $rate .= " <i class='star-rating'></i> ";
            }
            $rate .= " (" . round($this->CourseCountRating, 1) . ")</span>";
        }
        return $rate;
    }
    public function getCourseRatingDetailsAttribute()
    {
        // $ratingDetails = Coursereviews::where('courses_id',$this->id)->groupBy('rating')->select('COUNT(rating) as ratingCount','rating')->get;
        $ratingDetails = DB::table('coursereviews')
            ->select('rating', DB::raw('COUNT(rating) as ratingCount'))
            ->groupBy('rating')
            ->get();
        $count = 0;
        foreach ($ratingDetails as $item) {
            $count = $count + $item->ratingCount;
        }
        return array("ratingDetails" => $ratingDetails, "count" => $count);
    }
    public static function isEnrolledCourse($id, $userId = null)
    {
         if (!$userId AND !isset(Auth::user()->id)) {
            return false;
        }
                 $userId = ($userId) ? $userId : Auth::user()->id;
         if (!$userId) {
            return false;
        }
         $dateNow = date('Y-m-d H:i:s');
        $registeredCourse = Courseenrollment::where('user_id', $userId)->where('courses_id', $id)->whereDate('start_time', '<=', $dateNow)
            ->whereDate('end_time', '>=', $dateNow)
            ->where('status', 1)->first();
        return ($registeredCourse) ? true : false;
    }

    public static function isBusinessCourse($course_id){

        $businessdata_id = Auth::user()->businessdata_id;

        if($businessdata_id) {

            $isBusinessCourse = (count(Businesscourses::where('businessdata_id', $businessdata_id)->where('courses_id', $course_id)->get()) > 0) ? 1 : 0;

            if($isBusinessCourse) {
                
                return 1;

            }else {
                return 0;
            }

        }else{
            return 0;
        }

    }

    public static function isBusinessProfileInComplete() {

        $businessdata_id = Auth::user()->businessdata_id;

        if($businessdata_id) {

            $businessInputFields = Businessinputfields::where('businessdata_id', $businessdata_id)->get();

            if(count($businessInputFields) > 0) {
    
                foreach($businessInputFields as $businessInputField) {

                    $response = Businessinputfieldsresponses::where('businessinputfields_id', $businessInputField->id)->where('user_id', Auth::user()->id)->get();

                    if(count($response) == 0) {
                        return 1;
                    break;
                    }
                }

            }else {
                return 0;
            }
        }else {
            return 0;
        }

    }
    public static function inShoppingCart($id, $userId = null)
    {
        if (!$userId AND !isset(Auth::user()->id)) {
            return false;
        }
        $userId = ($userId) ? $userId : Auth::user()->id;
        $order = Orders::where('user_id', Auth::user()->id)->where('status', Orders::STATUS_PENDING)->orderBy('id', 'DESC')->first();
        if (!$order) {
            return false;
        }
        // Ceck if the order position found:
        $orderPosition = Ordersposition::where('courses_id', $id)->where('orders_id', $order->id)->first();
        return ($orderPosition) ? true : false;
    }
    public static function removeItemFromCart($id)
    {
        $orderPosition = Ordersposition::findOrfail($id);
        $order = $orderPosition->orders;
        if (!$order) {
            return false;
        }
        // Remove the order position
        $orderPosition->delete();
        // To set Kiosk id Null
        $order->kiosk_id = null;
        $order->update();
    }
    public static function cartItems($order_id = 0, $user_id = null)
    {
        $user_id = ($user_id) ? $user_id : Auth::user()->id;
        $cartItemsArr = array();
        $cartItemsArr["items"] = array();
        $cartItemsArr["totalCost"] = 0;
        $cartItemsArr["itemsCount"] = 0;
        $totalCost = 0;
        $count = 0;
        //        var_dump($user_id);//die;
        if (!$user_id) {
            return $cartItemsArr;
        }
        //check the current pending order and remove the related positions from the database:
        if ($order_id > 0) {
            $order = Orders::where('user_id', $user_id)->where('id', $order_id)->orderBy('id', 'DESC')->first();
        } else {
            $order = Orders::where('user_id', $user_id)->where(function ($query) {
                    $query->where('status', Orders::STATUS_PENDING)
                        //   ->orWhere('status', Orders::STATUS_VODAFONE)
                        //   ->orWhere('status', Orders::STATUS_KIOSK)
                    ;
                })->orderBy('id', 'DESC')->first();
        }
        if ($order && $order->ordersposition) {
            foreach ($order->ordersposition as $item) {
                if ($item->type == 1) {
                    $itemCourse = (int) $item->courses_id;
                    if (is_int($itemCourse) && $itemCourse > 0) {
                        $cartItemsArr["items"][] = $item->courses;
                        $price = $item->courses->OriginalPrice;
                        $totalCost += $price;
                    }
                    $count++;
                } elseif ($item->type == 2) {
                    $itemEvent = (int) $item->events_id;
                    if (is_int($itemEvent) && $itemEvent > 0) {
                        $cartItemsArr["items"][] = $item->events;
                        $price = $item->events->OriginalPrice;
                        $totalCost += $price;
                    }
                    $count++;
                }
            }
        }
        $cartItemsArr["totalCost"] = $totalCost;
        $cartItemsArr["itemsCount"] = $count;
        return $cartItemsArr;
    }
    public static function cartItemsTotalCost()
    {
        $totalCost = 0;
        //check the current pending order and remove the related positions from the database:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
                $query->where('status', Orders::STATUS_PENDING)
                    //   ->orWhere('status', Orders::STATUS_VODAFONE)
                    //   ->orWhere('status', Orders::STATUS_KIOSK)
                ;
            })->orderBy('id', 'DESC')->first();
        if ($order && $order->ordersposition) {
            foreach ($order->ordersposition as $item) {
                $itemCourse = (int) $item->courses_id;
                if (is_int($itemCourse) && $itemCourse > 0) {
                    $cartItemsArr["items"][] = $item->courses;
                    $price = $item->courses->OriginalPrice;
                    $totalCost += $price;
                }
            }
        }
        return $totalCost;
    }
    public function getCourseCountStudentsAttribute()
    {
        return Transactions::where('courses_id', $this->id)->where('user_id', Auth::user()->id)->where('price', '>', 0)->count();
    }

    public function getCourseCountStudentsFromTo($from, $to){
        return Transactions::where('courses_id', $this->id)->where('user_id', Auth::user()->id)->where('price', '>', 0)->whereBetween('date', [$from, $to])->count();
    }

    public function getCourseRevenueAttribute(){
        return Transactions::where('courses_id', $this->id)->where('user_id', Auth::user()->id)->sum('amount');
    }

    public function getCourseRevenueFromTo($from, $to){
        return Transactions::where('courses_id', $this->id)->where('user_id', Auth::user()->id)->whereBetween('date', [$from, $to])->sum('amount');
    }

    public static function generateWebinarCertificate($webinar, $name = "")
    {

        $title = $webinar->title_en;

        $randomNo = auth()->user()->id . "R1" . createRandomCode();
        $fileName = 'IGTS-WEBINAR-CRT-' . $randomNo;



        $viewhtml = View::make('website.certificates.igtsCert', array('course' => $webinar, 'name' => $name))->render();
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

        $webinarEnrollment = Courseenrollment::where('user_id', Auth::user()->id)->where('courses_id', $webinar->id)->first();
        
        $webinarEnrollment->certificate = $fileName . '.pdf';
        $webinarEnrollment->save();
            
        return $webinarEnrollment->certificate;

    }

    public static function hasWebinarCertificate($id)
    {

        $webinarEnrollment = Courseenrollment::where('user_id', Auth::user()->id)->where('courses_id', $id)->first();

        return ($webinarEnrollment && $webinarEnrollment->certificate) ? true : false;

    }


    public static function getAllVimeoTalks($cat_id = null)
    {
        $client_secret = 'w8D3FUROgKkVrN1J31CQzAuA0MC0Dal8yTC1vXZZd19F9QFQrOBC9KdULCwKXSP4VMRjTjSPi2/eSL6cbG18DMu84xdq+wmYKYpkJEva/S2kBTimTMzgw5Yx/6m4dOcy';
        $client_id = '45f3bdf1c9fbe7e1fff93e8d3134e873fa4c7465';
        $lib = new \Vimeo\Vimeo($client_id, $client_secret);
        $lib->setToken('12076904a3c1c199d3d87c6d41edf227');
        //        $response = $lib->request('/me/videos', ['per_page' => 2], 'GET');
        if ($cat_id) {
            $response = $lib->request('/me/projects/1345675/videos', ['per_page' => 100, 'query' => $cat_id . '_'], 'GET');
        } else {
            $response = $lib->request('/me/projects/1345675/videos', ['per_page' => 100], 'GET');
        }
        $videosList = ($response['status'] == "200") ? $response['body'] : array();
        return ($videosList) ? $videosList['data'] : array();
    }
    public static function getAllVimeoCourses($cat_id_course_id = null)
    {
        $client_secret = 'w8D3FUROgKkVrN1J31CQzAuA0MC0Dal8yTC1vXZZd19F9QFQrOBC9KdULCwKXSP4VMRjTjSPi2/eSL6cbG18DMu84xdq+wmYKYpkJEva/S2kBTimTMzgw5Yx/6m4dOcy';
        $client_id = '45f3bdf1c9fbe7e1fff93e8d3134e873fa4c7465';
        $lib = new \Vimeo\Vimeo($client_id, $client_secret);
        $lib->setToken('12076904a3c1c199d3d87c6d41edf227');
        //        $response = $lib->request('/me/videos', ['per_page' => 2], 'GET');
        if ($cat_id_course_id) {
            $response = $lib->request('/me/projects/1780796/videos', ['per_page' => 100, 'query' => $cat_id_course_id . '_'], 'GET');
        } else {
            $response = $lib->request('/me/projects/1780796/videos', ['per_page' => 100], 'GET');
        }
        $videosList = ($response['status'] == "200") ? $response['body'] : array();
        return ($videosList) ? $videosList['data'] : array();
    }
    public static function getSpecificVideo($id = null)
    {
        $client_secret = 'w8D3FUROgKkVrN1J31CQzAuA0MC0Dal8yTC1vXZZd19F9QFQrOBC9KdULCwKXSP4VMRjTjSPi2/eSL6cbG18DMu84xdq+wmYKYpkJEva/S2kBTimTMzgw5Yx/6m4dOcy';
        $client_id = '45f3bdf1c9fbe7e1fff93e8d3134e873fa4c7465';
        $lib = new \Vimeo\Vimeo($client_id, $client_secret);
        $lib->setToken('12076904a3c1c199d3d87c6d41edf227');
        //        $response = $lib->request('/me/videos', ['per_page' => 2], 'GET');
        $response = $lib->request('/videos/' . $id, 'GET');
        $videosList = ($response['status'] == "200") ? $response['body'] : array();
        return ($videosList) ? $videosList['duration'] : array();
    }
    public static function getAllVimeoPromos()
    {
        $client_secret = 'w8D3FUROgKkVrN1J31CQzAuA0MC0Dal8yTC1vXZZd19F9QFQrOBC9KdULCwKXSP4VMRjTjSPi2/eSL6cbG18DMu84xdq+wmYKYpkJEva/S2kBTimTMzgw5Yx/6m4dOcy';
        $client_id = '45f3bdf1c9fbe7e1fff93e8d3134e873fa4c7465';
        $lib = new \Vimeo\Vimeo($client_id, $client_secret);
        $lib->setToken('12076904a3c1c199d3d87c6d41edf227');
        //      $response = $lib->request('/me/videos', ['per_page' => 2], 'GET');
        $response = $lib->request('/me/projects/1780802/videos', ['per_page' => 100], 'GET');
        $videosList = ($response['status'] == "200") ? $response['body'] : array();
        return ($videosList) ? $videosList['data'] : array();
    }
    //****************** Start vdocipher   ******************
    public static function getAllVdocipherCourses($Course_slug, $pageNumber) {
        $Course_slug = str_replace('-', '_', $Course_slug);
        $curl = curl_init();
         curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos?tags=$Course_slug&limit=200&page=$pageNumber",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret 9ZSvMS6vr9zEfPEgtvl4AupoXpthbt6bO9sMz7m7n8tYRTclhKBXu6sWChZ2IVON",
                "Content-Type: application/json"
            ),
        ));
         $response = curl_exec($curl);
        $err = curl_error($curl);
         curl_close($curl);
         if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response);
        }
          $videosList = ($data->rows) ? $data->rows : array();
        return ($videosList) ? $videosList : array();
     }
    public static function getAllVdocipherPromoCourses()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos?tags=$Course_slug&limit=100",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret 9ZSvMS6vr9zEfPEgtvl4AupoXpthbt6bO9sMz7m7n8tYRTclhKBXu6sWChZ2IVON",
                "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response);
        }
        $videosList = ($data->rows) ? $data->rows : array();
        return ($videosList) ? $videosList : array();
    }
    public static function getSpecificVideoVdocipher($id = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret 9ZSvMS6vr9zEfPEgtvl4AupoXpthbt6bO9sMz7m7n8tYRTclhKBXu6sWChZ2IVON",
                "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response);
        }
        $videosList = ($data) ? $data : array();
        return (isset($videosList->length)) ? $videosList : null;
    }
    //****************** End vdocipher   ******************
      public function getIncludedCoursesLecturesSum(){
         $sum = 0;
        foreach($this->courseincludes as $includedCourse){
                                       $sum += count($includedCourse->includedCourse->courselectures);
        }
         return $sum;
             }
     public function getIncludedCoursesResourcesSum(){
         $sum = 0;
        foreach($this->courseincludes as $includedCourse){
                                       $sum += count($includedCourse->includedCourse->courseresources);
        }
         return $sum;
             }

        public function getIncludedCoursesOriginalPriceSumAttribute()
        {
            $sum = 0;
            foreach($this->courseincludes as $includedCourse){
                $sum += $includedCourse->includedCourse->OriginalPrice;
            }
            return $sum;
        }
         

        public function getIncludedCoursesPriceSum(){

            $sum = 0;
            
            foreach($this->courseincludes as $includedCourse){
                
                if(getCurrency() == 'USD'){
                    //get Exchange rate
                    $exchangeRate = Payments::exchangeRate();

                    $course_price = round($exchangeRate * $includedCourse->includedCourse->price_in_dollar);
                }else{
                    $course_price = $includedCourse->includedCourse->price;
                }

                $sum += $course_price;
    
            }
    
            return $sum;
        }
        
     public static function getVdoCipherOTP($vidID){
                       $curl = curl_init();
         curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dev.vdocipher.com/api/videos/$vidID/otp",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode([
            "ttl" => 300,
            "whitelisthref" => "igtsservice.com",

          ]),
          CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Authorization: Apisecret 9ZSvMS6vr9zEfPEgtvl4AupoXpthbt6bO9sMz7m7n8tYRTclhKBXu6sWChZ2IVON",
            "Content-Type: application/json"
          ),
        ));
                 $response = curl_exec($curl);
                            $err = curl_error($curl);
                 curl_close($curl);
                 return json_decode($response);
             }
}
