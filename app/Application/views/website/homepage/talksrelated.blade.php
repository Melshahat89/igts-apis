<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('talksrelated') }}</h2>
<hr>
@php $sidebarTalksrelated = \App\Application\Model\Talksrelated::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTalksrelated) > 0)
			@foreach ($sidebarTalksrelated as $d)
				 <div>
					<h2 > {{ str_limit($d->position , 50) }}</h2 > 
					 <p><a href="{{ url("talksrelated/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			