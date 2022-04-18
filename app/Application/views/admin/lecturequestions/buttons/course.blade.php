<?php

    use App\Application\Model\Lecturequestions;
use App\Application\Model\Lecturequestionsanswers;

$lectureQuestion = Lecturequestions::find($id);
    
    $course = '';
    if($lectureQuestion){
        $course = isset($lectureQuestion->courselectures->courses) ? $lectureQuestion->courselectures->courses->title_lang : '';
    }

?>

{{ $course }}