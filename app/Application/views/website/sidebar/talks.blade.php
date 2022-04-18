<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('talks') }}</h2>
<hr>
@php $sidebarTalks = \App\Application\Model\Talks::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTalks) > 0)
			@foreach ($sidebarTalks as $d)
				 <div>
					<a href="{{ url("talks/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("talks/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			