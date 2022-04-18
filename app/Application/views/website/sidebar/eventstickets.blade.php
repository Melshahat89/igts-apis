<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('eventstickets') }}</h2>
<hr>
@php $sidebarEventstickets = \App\Application\Model\Eventstickets::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarEventstickets) > 0)
			@foreach ($sidebarEventstickets as $d)
				 <div>
					<p><a href="{{ url("eventstickets/".$d->id."/view") }}">{{ str_limit($d->name , 20) }}</a></p > 
					<p><a href="{{ url("eventstickets/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			