<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('ordersposition') }}</h2>
<hr>
@php $sidebarOrdersposition = \App\Application\Model\Ordersposition::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarOrdersposition) > 0)
			@foreach ($sidebarOrdersposition as $d)
				 <div>
					<h2 > {{ str_limit($d->amount , 50) }}</h2 > 
					<p> {{ str_limit($d->notes , 300) }}</p > 
					<p> {{ str_limit($d->certificate_id , 300) }}</p > 
					 <p><a href="{{ url("ordersposition/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			