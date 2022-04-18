<?php

use App\Application\Model\Transactions;

$transaction = Transactions::find($id);

?>
{{ $transaction->user->Fullname_lang }}