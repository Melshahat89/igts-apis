<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('quiz') }}</h2>
<hr>
@php $sidebarQuiz = \App\Application\Model\Quiz::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarQuiz) > 0)
			@foreach ($sidebarQuiz as $d)
				 <div>
					<a href="{{ url("quiz/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("quiz/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			