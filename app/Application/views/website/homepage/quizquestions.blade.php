<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('quizquestions') }}</h2>
<hr>
@php $sidebarQuizquestions = \App\Application\Model\Quizquestions::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarQuizquestions) > 0)
			@foreach ($sidebarQuizquestions as $d)
				 <div>
					<h2 > {{ str_limit($d->question_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->type , 300) }}</p > 
					<p> {{ str_limit($d->mark , 300) }}</p > 
					 <p><a href="{{ url("quizquestions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			