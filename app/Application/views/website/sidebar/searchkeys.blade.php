<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('searchkeys') }}</h2>
<hr>
@php $sidebarSearchkeys = \App\Application\Model\Searchkeys::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarSearchkeys) > 0)
			@foreach ($sidebarSearchkeys as $d)
				 <div>
					<p><a href="{{ url("searchkeys/".$d->id."/view") }}">{{ str_limit($d->word , 20) }}</a></p > 
					<p><a href="{{ url("searchkeys/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			