<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('lecturequestions') }}</h2>
<hr>
@php $sidebarLecturequestions = \App\Application\Model\Lecturequestions::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarLecturequestions) > 0)
			@foreach ($sidebarLecturequestions as $d)
				 <div>
					<p><a href="{{ url("lecturequestions/".$d->id."/view") }}">{{ str_limit($d->question_title , 20) }}</a></p > 
					<p><a href="{{ url("lecturequestions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			