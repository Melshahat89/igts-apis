<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('careersresponses') }}</h2>
<hr>
@php $sidebarCareersresponses = \App\Application\Model\Careersresponses::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCareersresponses) > 0)
			@foreach ($sidebarCareersresponses as $d)
				 <div>
					<p><a href="{{ url("careersresponses/".$d->id."/view") }}">{{ str_limit($d->name , 20) }}</a></p > 
					<p><a href="{{ url("careersresponses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			