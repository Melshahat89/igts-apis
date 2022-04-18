<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('talks') }}</h2>
<hr>
@php $sidebarTalks = \App\Application\Model\Talks::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTalks) > 0)
			@foreach ($sidebarTalks as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->slug , 300) }}</p > 
					<p> {{ str_limit($d->subtitle_lang , 300) }}</p > 
					 <p><a href="{{ url("talks/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			