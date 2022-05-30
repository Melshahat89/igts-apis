<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model{

    public $table = "paymentmethods";

    protected $fillable = [
        'title',
        'logo', 
        'status',
        'action',
        'class',
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

}