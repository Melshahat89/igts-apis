<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class BecomeInstructor extends Model
{

  public $table = "becomeinstructor";


   protected $fillable = [
        'name','email','phone','title','specialist','yourCourses','cv','socialAccount','status','dateOfBirth','country'
   ];


}
