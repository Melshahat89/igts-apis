<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('talksrelated') }}</h2>
<hr>
@php $sidebarTalksrelated = \App\Application\Model\Talksrelated::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTalksrelated) > 0)
			@foreach ($sidebarTalksrelated as $d)
				 <div>
					<p><a href="{{ url("talksrelated/".$d->id."/view") }}">{{ str_limit($d->position , 20) }}</a></p > 
					<p><a href="{{ url("talksrelated/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			