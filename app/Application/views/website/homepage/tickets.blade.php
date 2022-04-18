<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('tickets') }}</h2>
<hr>
@php $sidebarTickets = \App\Application\Model\Tickets::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTickets) > 0)
			@foreach ($sidebarTickets as $d)
				 <div>
					<h2 > {{ str_limit($d->reciver_id , 50) }}</h2 > 
					<p> {{ str_limit($d->status , 300) }}</p > 
					<p> {{ str_limit($d->type , 300) }}</p > 
					 <p><a href="{{ url("tickets/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			