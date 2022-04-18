<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courses') }}</h2>
<hr>
@php $sidebarCourses = \App\Application\Model\Courses::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourses) > 0)
			@foreach ($sidebarCourses as $d)
				 <div>
					<a href="{{ url("courses/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("courses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			