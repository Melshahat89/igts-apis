<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courseenrollment') }}</h2>
<hr>
@php $sidebarCourseenrollment = \App\Application\Model\Courseenrollment::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourseenrollment) > 0)
			@foreach ($sidebarCourseenrollment as $d)
				 <div>
					<h2 > {{ str_limit($d->start_time , 50) }}</h2 > 
					<p> {{ str_limit($d->end_time , 300) }}</p > 
					{{ $d->status == 1 ? trans("courseenrollment.Yes") : trans("courseenrollment.No")  }}
					 <p><a href="{{ url("courseenrollment/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			