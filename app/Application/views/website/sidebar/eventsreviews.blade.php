<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('eventsreviews') }}</h2>
<hr>
@php $sidebarEventsreviews = \App\Application\Model\Eventsreviews::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarEventsreviews) > 0)
			@foreach ($sidebarEventsreviews as $d)
				 <div>
					<p><a href="{{ url("eventsreviews/".$d->id."/view") }}">{{ str_limit($d->review , 20) }}</a></p > 
					<p><a href="{{ url("eventsreviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			