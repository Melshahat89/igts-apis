<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('coursesections') }}</h2>
<hr>
@php $sidebarCoursesections = \App\Application\Model\Coursesections::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCoursesections) > 0)
			@foreach ($sidebarCoursesections as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->will_do_at_the_end_lang , 300) }}</p > 
					<p> {{ str_limit($d->position , 300) }}</p > 
					 <p><a href="{{ url("coursesections/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			