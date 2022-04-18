<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courses') }}</h2>
<hr>
@php $sidebarCourses = \App\Application\Model\Courses::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourses) > 0)
			@foreach ($sidebarCourses as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->slug , 300) }}</p > 
					<p> {{ str_limit($d->description_lang , 300) }}</p > 
					 <p><a href="{{ url("courses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			