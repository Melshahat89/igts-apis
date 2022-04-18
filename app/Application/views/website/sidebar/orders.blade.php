<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('orders') }}</h2>
<hr>
@php $sidebarOrders = \App\Application\Model\Orders::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarOrders) > 0)
			@foreach ($sidebarOrders as $d)
				 <div>
					<p><a href="{{ url("orders/".$d->id."/view") }}">{{ str_limit($d->status , 20) }}</a></p > 
					<p><a href="{{ url("orders/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			