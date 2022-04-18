<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courseenrollment') }}</h2>
<hr>
@php $sidebarCourseenrollment = \App\Application\Model\Courseenrollment::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourseenrollment) > 0)
			@foreach ($sidebarCourseenrollment as $d)
				 <div>
					<p><a href="{{ url("courseenrollment/".$d->id."/view") }}">{{ str_limit($d->start_time , 20) }}</a></p > 
					<p><a href="{{ url("courseenrollment/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			