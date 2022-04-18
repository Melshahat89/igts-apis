<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('eventsreviews') }}</h2>
<hr>
@php $sidebarEventsreviews = \App\Application\Model\Eventsreviews::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarEventsreviews) > 0)
			@foreach ($sidebarEventsreviews as $d)
				 <div>
					<h2 > {{ str_limit($d->review , 50) }}</h2 > 
					<p> {{ str_limit($d->rating , 300) }}</p > 
					 <p><a href="{{ url("eventsreviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			