<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('payments') }}</h2>
<hr>
@php $sidebarPayments = \App\Application\Model\Payments::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPayments) > 0)
			@foreach ($sidebarPayments as $d)
				 <div>
					<p><a href="{{ url("payments/".$d->id."/view") }}">{{ str_limit($d->operation , 20) }}</a></p > 
					<p><a href="{{ url("payments/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			