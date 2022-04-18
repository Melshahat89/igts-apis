<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('eventsdata') }}</h2>
<hr>
@php $sidebarEventsdata = \App\Application\Model\Eventsdata::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarEventsdata) > 0)
			@foreach ($sidebarEventsdata as $d)
				 <div>
					<h2 > {{ str_limit($d->name_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->email , 300) }}</p > 
					 <img src="{{ small($d->logo)}}"  width = "80" />
					 <p><a href="{{ url("eventsdata/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			