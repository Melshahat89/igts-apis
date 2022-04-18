@if($payments_id)


                @php $payments = App\Application\Model\Payments::find($payments_id);  @endphp
                @if($payments)
				{{$payments['accept_source_data_sub_type']}}
                @endif

@endif