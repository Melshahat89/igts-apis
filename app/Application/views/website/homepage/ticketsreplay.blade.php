<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('ticketsreplay') }}</h2>
<hr>
@php $sidebarTicketsreplay = \App\Application\Model\Ticketsreplay::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTicketsreplay) > 0)
			@foreach ($sidebarTicketsreplay as $d)
				 <div>
					<h2 > {{ str_limit($d->message , 50) }}</h2 > 
					<p> {{ str_limit($d->reciver_id , 300) }}</p > 
					 <p><a href="{{ url("ticketsreplay/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			