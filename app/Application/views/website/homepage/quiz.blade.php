<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('quiz') }}</h2>
<hr>
@php $sidebarQuiz = \App\Application\Model\Quiz::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarQuiz) > 0)
			@foreach ($sidebarQuiz as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->description_lang , 300) }}</p > 
					<p> {{ str_limit($d->instructions , 300) }}</p > 
					 <p><a href="{{ url("quiz/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			