<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Certificates extends Model
{
    public $table = "certificates";
    protected $fillable = [
        'title',
        'price_egp',
        'price_usd',
        'visible',
    ];


    public function certificatesrelatedcourses(){
        return $this->belongsToMany(Courses::class, 'certificatescontainer','certificate_id','courses_id');
    }

    // public function certificatescontainersync(){
    //     return $this->belongsToMany(Courses::class, 'certificatescontainer','courses_id','certificate_id');
    // }
    
    public function getTitleLangAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->{getCurrentLang()} : $this->title;
    }

    public function getTitleEnAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->en : $this->title;
    }

    public function getTitleArAttribute()
    {
        return is_json($this->title) && is_object(json_decode($this->title)) ? json_decode($this->title)->ar : $this->title;
    }

    public static function isBoughtCertificate($courses_id, $certificate_id){
        if(!Auth::check())
            return false;
        
        $certificate = Certificatesenrollment::where('courses_id', $courses_id)->where('certificate_id', $certificate_id)->where('user_id', Auth::user()->id)->first();
        
        return ($certificate) ? TRUE : FALSE;
    }

    public function getPriceAttribute()
    {

        $currency = getCurrency();
        if ($currency == "EGP") {

            $price = $this->price_egp;

        }else{

            $price = $this->price_usd;

        }

        return $price;

    }


}
