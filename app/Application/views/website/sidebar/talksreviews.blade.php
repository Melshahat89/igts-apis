<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('talksreviews') }}</h2>
<hr>
@php $sidebarTalksreviews = \App\Application\Model\Talksreviews::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTalksreviews) > 0)
			@foreach ($sidebarTalksreviews as $d)
				 <div>
					<p><a href="{{ url("talksreviews/".$d->id."/view") }}">{{ str_limit($d->review , 20) }}</a></p > 
					<p><a href="{{ url("talksreviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			