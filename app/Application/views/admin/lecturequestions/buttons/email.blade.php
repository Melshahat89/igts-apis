<?php

use App\Application\Model\Lecturequestions;
use App\Application\Model\User;

$lectureQuestion = Lecturequestions::find($id);
$user = null;

if(isset($lectureQuestion)){
    $user = User::find($lectureQuestion->user_id);
}

?>

{{ isset($user) ? $user->email : '' }}