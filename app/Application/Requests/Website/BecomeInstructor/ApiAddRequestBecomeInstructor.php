<?php

namespace App\Application\Requests\Website\BecomeInstructor;


class ApiAddRequestBecomeInstructor
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'phone' => 'required|max:15',
            'email' => 'required|email|max:255',
            'title' => 'required|max:1000',
            'specialist' => 'required|int',
//            'yourCourses' => 'required|max:255',
            'cv' => 'file|required'
			
        ];
    }
}
