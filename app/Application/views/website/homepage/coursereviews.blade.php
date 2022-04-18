<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('coursereviews') }}</h2>
<hr>
@php $sidebarCoursereviews = \App\Application\Model\Coursereviews::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCoursereviews) > 0)
			@foreach ($sidebarCoursereviews as $d)
				 <div>
					<h2 > {{ str_limit($d->review , 50) }}</h2 > 
					<p> {{ str_limit($d->rating , 300) }}</p > 
					{{ $d->type == 1 ? trans("coursereviews.Yes") : trans("coursereviews.No")  }}
					 <p><a href="{{ url("coursereviews/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			