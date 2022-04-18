<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('talklikes') }}</h2>
<hr>
@php $sidebarTalklikes = \App\Application\Model\Talklikes::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTalklikes) > 0)
			@foreach ($sidebarTalklikes as $d)
				 <div>
					<p><a href="{{ url("talklikes/".$d->id."/view") }}">{{ str_limit($d->comment , 20) }}</a></p > 
					<p><a href="{{ url("talklikes/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			