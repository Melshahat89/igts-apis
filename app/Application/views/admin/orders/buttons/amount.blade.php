@if($payments_id)
    @php $payments = App\Application\Model\Payments::find($payments_id);  @endphp
    @if($payments)
    {{  $payments['amount']}} {{ ($payments->currency_id == 34) ? 'EGP' : 'USD'  }}
    @endif
@endif