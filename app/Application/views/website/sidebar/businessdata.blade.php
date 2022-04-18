<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('businessdata') }}</h2>
<hr>
@php $sidebarBusinessdata = \App\Application\Model\Businessdata::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBusinessdata) > 0)
			@foreach ($sidebarBusinessdata as $d)
				 <div>
					<a href="{{ url("businessdata/".$d->id."/view") }}" ><p>{{ str_limit($d->name_lang , 20) }}</a></p > 
					<p><a href="{{ url("businessdata/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			