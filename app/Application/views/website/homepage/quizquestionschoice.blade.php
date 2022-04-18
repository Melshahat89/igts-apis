<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('quizquestionschoice') }}</h2>
<hr>
@php $sidebarQuizquestionschoice = \App\Application\Model\Quizquestionschoice::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarQuizquestionschoice) > 0)
			@foreach ($sidebarQuizquestionschoice as $d)
				 <div>
					<h2 > {{ str_limit($d->choice_lang , 50) }}</h2 > 
					{{ $d->is_correct == 1 ? trans("quizquestionschoice.Yes") : trans("quizquestionschoice.No")  }}
					 <p><a href="{{ url("quizquestionschoice/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			