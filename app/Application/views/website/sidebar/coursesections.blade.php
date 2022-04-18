<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('coursesections') }}</h2>
<hr>
@php $sidebarCoursesections = \App\Application\Model\Coursesections::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCoursesections) > 0)
			@foreach ($sidebarCoursesections as $d)
				 <div>
					<a href="{{ url("coursesections/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("coursesections/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			