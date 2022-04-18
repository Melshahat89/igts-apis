

{{--  @if($status == 2 OR $status == 1)  --}}

@php $positions = App\Application\Model\Ordersposition::where('orders_id',$id)->get();  @endphp
@if(isset($positions))
    @foreach($positions as $key => $position)
            {{$position->courses['title_lang'] }} ,
    @endforeach
@endif


{{--  @endif  --}}