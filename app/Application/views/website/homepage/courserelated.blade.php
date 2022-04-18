<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courserelated') }}</h2>
<hr>
@php $sidebarCourserelated = \App\Application\Model\Courserelated::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourserelated) > 0)
			@foreach ($sidebarCourserelated as $d)
				 <div>
					<h2 > {{ str_limit($d->position , 50) }}</h2 > 
					 <p><a href="{{ url("courserelated/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			