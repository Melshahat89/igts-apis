<?php

use App\Application\Model\Orders;

$order = Orders::findOrFail($id);

?>
<a href="{{ url('/lazyadmin/orders/'.$id.'/approve') }}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float {{ ($order->status == Orders::STATUS_SUCCEEDED) ? 'disabled' : '' }}">
    Click
</a>