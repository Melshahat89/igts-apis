<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('coursereviews') }}</h2>
<hr>
@php $sidebarCoursereviews = \App\Application\Model\Coursereviews::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCoursereviews) > 0)
			@foreach ($sidebarCoursereviews as $d)
				 <div>
					<p><a href="{{ url("coursereviews/".$d->id."/view") }}">{{ str_limit($d->review , 20) }}</a></p > 
					<p><a href="{{ url("coursereviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			