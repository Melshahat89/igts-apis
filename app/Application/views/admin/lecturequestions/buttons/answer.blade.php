<?php

    use App\Application\Model\Lecturequestions;
use App\Application\Model\Lecturequestionsanswers;

$lectureQuestion = Lecturequestions::find($id);
    
    $answer = '';
    if($lectureQuestion){
        $answer = Lecturequestionsanswers::where('lecturequestions_id', $lectureQuestion->id)->where('is_instructor', 1)->orderBy('id', 'DESC')->first();
    }

?>

{{ isset($answer) ? $answer->answer : '' }}