<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('orders') }}</h2>
<hr>
@php $sidebarOrders = \App\Application\Model\Orders::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarOrders) > 0)
			@foreach ($sidebarOrders as $d)
				 <div>
					<h2 > {{ str_limit($d->status , 50) }}</h2 > 
					<p> {{ str_limit($d->comments , 300) }}</p > 
					<p> {{ str_limit($d->billing_address_id , 300) }}</p > 
					 <p><a href="{{ url("orders/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			