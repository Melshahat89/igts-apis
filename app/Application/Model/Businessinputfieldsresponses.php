<?php
 namespace App\Application\Model;
 use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Businessinputfieldsresponses extends Model
{
     public $table = "businessinputfieldsresponses";
     public $timestamps = false;
     


     protected $fillable = [
   'businessinputfields_id',
        'user_id','answer'
   ];


   public static function getFieldResponseByUser($fieldName){

     $field = Businessinputfields::where('field_name', $fieldName)->first();
     $response = Businessinputfieldsresponses::where('businessinputfields_id', $field->id)->where('user_id', Auth::user()->id)->first();
     
     return ($response) ? $response->answer : '';
   }

   

  }
