<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('quizquestionschoice') }}</h2>
<hr>
@php $sidebarQuizquestionschoice = \App\Application\Model\Quizquestionschoice::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarQuizquestionschoice) > 0)
			@foreach ($sidebarQuizquestionschoice as $d)
				 <div>
					<a href="{{ url("quizquestionschoice/".$d->id."/view") }}" ><p>{{ str_limit($d->choice_lang , 20) }}</a></p > 
					<p><a href="{{ url("quizquestionschoice/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			