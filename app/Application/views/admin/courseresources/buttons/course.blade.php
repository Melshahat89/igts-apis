<?php

use App\Application\Model\Courses;

$course = Courses::where('id', $courses_id)->get();

echo $course[0]->title_lang;