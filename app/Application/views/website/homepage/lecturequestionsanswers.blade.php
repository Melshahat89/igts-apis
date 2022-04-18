<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('lecturequestionsanswers') }}</h2>
<hr>
@php $sidebarLecturequestionsanswers = \App\Application\Model\Lecturequestionsanswers::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarLecturequestionsanswers) > 0)
			@foreach ($sidebarLecturequestionsanswers as $d)
				 <div>
					<h2 > {{ str_limit($d->answer , 50) }}</h2 > 
					 <p><a href="{{ url("lecturequestionsanswers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			