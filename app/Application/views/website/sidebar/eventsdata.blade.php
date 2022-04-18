<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('eventsdata') }}</h2>
<hr>
@php $sidebarEventsdata = \App\Application\Model\Eventsdata::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarEventsdata) > 0)
			@foreach ($sidebarEventsdata as $d)
				 <div>
					<a href="{{ url("eventsdata/".$d->id."/view") }}" ><p>{{ str_limit($d->name_lang , 20) }}</a></p > 
					<p><a href="{{ url("eventsdata/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			