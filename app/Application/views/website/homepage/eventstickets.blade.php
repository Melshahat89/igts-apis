<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('eventstickets') }}</h2>
<hr>
@php $sidebarEventstickets = \App\Application\Model\Eventstickets::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarEventstickets) > 0)
			@foreach ($sidebarEventstickets as $d)
				 <div>
					<h2 > {{ str_limit($d->name , 50) }}</h2 > 
					<p> {{ str_limit($d->email , 300) }}</p > 
					<p> {{ str_limit($d->code , 300) }}</p > 
					 <p><a href="{{ url("eventstickets/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			