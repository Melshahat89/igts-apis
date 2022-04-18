<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courseresources') }}</h2>
<hr>
@php $sidebarCourseresources = \App\Application\Model\Courseresources::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourseresources) > 0)
			@foreach ($sidebarCourseresources as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					 <a href="{{ url(env("UPLOAD_PATH")."/".$d->file)}}" ><i class="fa fa-file"></i></a>
					 <p><a href="{{ url("courseresources/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			