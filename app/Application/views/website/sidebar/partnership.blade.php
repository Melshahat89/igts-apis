<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('partnership') }}</h2>
<hr>
@php $sidebarPartnership = \App\Application\Model\Partnership::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPartnership) > 0)
			@foreach ($sidebarPartnership as $d)
				 <div>
					<p><a href="{{ url("partnership/".$d->id."/view") }}">{{ str_limit($d->setting , 20) }}</a></p > 
					<p><a href="{{ url("partnership/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			