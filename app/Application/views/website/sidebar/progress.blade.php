<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('progress') }}</h2>
<hr>
@php $sidebarProgress = \App\Application\Model\Progress::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarProgress) > 0)
			@foreach ($sidebarProgress as $d)
				 <div>
					<p><a href="{{ url("progress/".$d->id."/view") }}">{{ str_limit($d->percentage , 20) }}</a></p > 
					<p><a href="{{ url("progress/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			