<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('quizstudentsstatus') }}</h2>
<hr>
@php $sidebarQuizstudentsstatus = \App\Application\Model\Quizstudentsstatus::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarQuizstudentsstatus) > 0)
			@foreach ($sidebarQuizstudentsstatus as $d)
				 <div>
					<p><a href="{{ url("quizstudentsstatus/".$d->id."/view") }}">{{ str_limit($d->start_time , 20) }}</a></p > 
					<p><a href="{{ url("quizstudentsstatus/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			