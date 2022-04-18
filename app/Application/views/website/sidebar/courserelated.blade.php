<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courserelated') }}</h2>
<hr>
@php $sidebarCourserelated = \App\Application\Model\Courserelated::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourserelated) > 0)
			@foreach ($sidebarCourserelated as $d)
				 <div>
					<p><a href="{{ url("courserelated/".$d->id."/view") }}">{{ str_limit($d->position , 20) }}</a></p > 
					<p><a href="{{ url("courserelated/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			