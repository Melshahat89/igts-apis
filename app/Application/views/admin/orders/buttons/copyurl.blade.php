<?php

use App\Application\Model\Orders;

$order = Orders::find($id);
?>

@if($order->type == Orders::TYPE_OFFLINE && $order->status != Orders::STATUS_SUCCEEDED)
<a href="javascript: void(0)" onclick="copyUrl('{{$id}}')" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
    Copy URL
</a>

<script>
        function copyUrl(ID){
        navigator.clipboard.writeText("{{ concatenateLangToUrl('directpay') }}/" + ID).then(() => {
            alert("Copied To Clipboard");
        }).catch(() => {
            alert("Failed To Copy");
        });

    }
</script>
@endif