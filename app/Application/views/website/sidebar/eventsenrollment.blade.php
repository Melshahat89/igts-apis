<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('eventsenrollment') }}</h2>
<hr>
@php $sidebarEventsenrollment = \App\Application\Model\Eventsenrollment::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarEventsenrollment) > 0)
			@foreach ($sidebarEventsenrollment as $d)
				 <div>
					<p><a href="{{ url("eventsenrollment/".$d->id."/view") }}">{{ str_limit($d->start_time , 20) }}</a></p > 
					<p><a href="{{ url("eventsenrollment/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			