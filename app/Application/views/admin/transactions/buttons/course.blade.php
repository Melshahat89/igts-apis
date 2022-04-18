<?php

use App\Application\Model\Transactions;

$transaction = Transactions::find($id);

?>
{{ $transaction->courses->title_lang }}