<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('searchkeys') }}</h2>
<hr>
@php $sidebarSearchkeys = \App\Application\Model\Searchkeys::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarSearchkeys) > 0)
			@foreach ($sidebarSearchkeys as $d)
				 <div>
					<h2 > {{ str_limit($d->word , 50) }}</h2 > 
					<p> {{ str_limit($d->ip , 300) }}</p > 
					<p> {{ str_limit($d->country , 300) }}</p > 
					 <p><a href="{{ url("searchkeys/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			