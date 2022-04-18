<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('talksreviews') }}</h2>
<hr>
@php $sidebarTalksreviews = \App\Application\Model\Talksreviews::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTalksreviews) > 0)
			@foreach ($sidebarTalksreviews as $d)
				 <div>
					<h2 > {{ str_limit($d->review , 50) }}</h2 > 
					<p> {{ str_limit($d->rating , 300) }}</p > 
					 <p><a href="{{ url("talksreviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			