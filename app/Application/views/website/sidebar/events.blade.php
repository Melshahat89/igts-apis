<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('events') }}</h2>
<hr>
@php $sidebarEvents = \App\Application\Model\Events::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarEvents) > 0)
			@foreach ($sidebarEvents as $d)
				 <div>
					<a href="{{ url("events/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("events/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			