<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('ticketsreplay') }}</h2>
<hr>
@php $sidebarTicketsreplay = \App\Application\Model\Ticketsreplay::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTicketsreplay) > 0)
			@foreach ($sidebarTicketsreplay as $d)
				 <div>
					<p><a href="{{ url("ticketsreplay/".$d->id."/view") }}">{{ str_limit($d->message , 20) }}</a></p > 
					<p><a href="{{ url("ticketsreplay/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			