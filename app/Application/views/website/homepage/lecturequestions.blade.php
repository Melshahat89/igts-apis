<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('lecturequestions') }}</h2>
<hr>
@php $sidebarLecturequestions = \App\Application\Model\Lecturequestions::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarLecturequestions) > 0)
			@foreach ($sidebarLecturequestions as $d)
				 <div>
					<h2 > {{ str_limit($d->question_title , 50) }}</h2 > 
					<p> {{ str_limit($d->question_description , 300) }}</p > 
					{{ $d->approve == 1 ? trans("lecturequestions.Yes") : trans("lecturequestions.No")  }}
					 <p><a href="{{ url("lecturequestions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			