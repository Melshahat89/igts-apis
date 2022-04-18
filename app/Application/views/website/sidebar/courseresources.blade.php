<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courseresources') }}</h2>
<hr>
@php $sidebarCourseresources = \App\Application\Model\Courseresources::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourseresources) > 0)
			@foreach ($sidebarCourseresources as $d)
				 <div>
					<a href="{{ url("courseresources/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("courseresources/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			