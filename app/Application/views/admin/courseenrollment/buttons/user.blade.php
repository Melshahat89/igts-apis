<?php

use App\Application\Model\User;

$user = User::where('id', $user_id)->get();

echo $user[0]->email;