<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('tickets') }}</h2>
<hr>
@php $sidebarTickets = \App\Application\Model\Tickets::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTickets) > 0)
			@foreach ($sidebarTickets as $d)
				 <div>
					<p><a href="{{ url("tickets/".$d->id."/view") }}">{{ str_limit($d->reciver_id , 20) }}</a></p > 
					<p><a href="{{ url("tickets/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			