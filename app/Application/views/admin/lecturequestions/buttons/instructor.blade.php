<?php

    use App\Application\Model\Lecturequestions;
use App\Application\Model\Lecturequestionsanswers;

$lectureQuestion = Lecturequestions::find($id);
    
    $instructor = '';
    if($lectureQuestion){
        $instructor = isset($lectureQuestion->courselectures->courses->instructor) ? $lectureQuestion->courselectures->courses->instructor->Fullname_lang : '';
    }

?>

{{ $instructor }}