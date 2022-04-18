@if($payments_id)
    <a href="{{ url('/lazyadmin/payments/'.$payments_id.'/view') }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
        <i class="file-icons">Payment</i>
    </a>
@endif