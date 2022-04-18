<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('ordersposition') }}</h2>
<hr>
@php $sidebarOrdersposition = \App\Application\Model\Ordersposition::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarOrdersposition) > 0)
			@foreach ($sidebarOrdersposition as $d)
				 <div>
					<p><a href="{{ url("ordersposition/".$d->id."/view") }}">{{ str_limit($d->amount , 20) }}</a></p > 
					<p><a href="{{ url("ordersposition/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			