<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('quizstudentsstatus') }}</h2>
<hr>
@php $sidebarQuizstudentsstatus = \App\Application\Model\Quizstudentsstatus::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarQuizstudentsstatus) > 0)
			@foreach ($sidebarQuizstudentsstatus as $d)
				 <div>
					<h2 > {{ str_limit($d->start_time , 50) }}</h2 > 
					<p> {{ str_limit($d->end_time , 300) }}</p > 
					<p> {{ str_limit($d->pause_time , 300) }}</p > 
					 <p><a href="{{ url("quizstudentsstatus/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			