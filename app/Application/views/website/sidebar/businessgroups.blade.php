<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('businessgroups') }}</h2>
<hr>
@php $sidebarBusinessgroups = \App\Application\Model\Businessgroups::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBusinessgroups) > 0)
			@foreach ($sidebarBusinessgroups as $d)
				 <div>
					<p><a href="{{ url("businessgroups/".$d->id."/view") }}">{{ str_limit($d->name , 20) }}</a></p > 
					<p><a href="{{ url("businessgroups/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			