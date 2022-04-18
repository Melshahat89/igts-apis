<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('social') }}</h2>
<hr>
@php $sidebarSocial = \App\Application\Model\Social::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarSocial) > 0)
			@foreach ($sidebarSocial as $d)
				 <div>
					<p><a href="{{ url("social/".$d->id."/view") }}">{{ str_limit($d->user_id , 20) }}</a></p > 
					<p><a href="{{ url("social/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			