<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('quizstudentsanswers') }}</h2>
<hr>
@php $sidebarQuizstudentsanswers = \App\Application\Model\Quizstudentsanswers::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarQuizstudentsanswers) > 0)
			@foreach ($sidebarQuizstudentsanswers as $d)
				 <div>
					{{ $d->is_correct == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
					<p><a href="{{ url("quizstudentsanswers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			