<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('quizquestions') }}</h2>
<hr>
@php $sidebarQuizquestions = \App\Application\Model\Quizquestions::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarQuizquestions) > 0)
			@foreach ($sidebarQuizquestions as $d)
				 <div>
					<a href="{{ url("quizquestions/".$d->id."/view") }}" ><p>{{ str_limit($d->question_lang , 20) }}</a></p > 
					<p><a href="{{ url("quizquestions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			