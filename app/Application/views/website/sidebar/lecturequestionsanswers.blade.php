<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('lecturequestionsanswers') }}</h2>
<hr>
@php $sidebarLecturequestionsanswers = \App\Application\Model\Lecturequestionsanswers::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarLecturequestionsanswers) > 0)
			@foreach ($sidebarLecturequestionsanswers as $d)
				 <div>
					<p><a href="{{ url("lecturequestionsanswers/".$d->id."/view") }}">{{ str_limit($d->answer , 20) }}</a></p > 
					<p><a href="{{ url("lecturequestionsanswers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			