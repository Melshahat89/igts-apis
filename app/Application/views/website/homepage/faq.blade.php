<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('faq') }}</h2>
<hr>
@php $sidebarFaq = \App\Application\Model\Faq::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarFaq) > 0)
			@foreach ($sidebarFaq as $d)
				 <div>
					<h2 > {{ str_limit($d->group_id , 50) }}</h2 > 
					<p> {{ str_limit($d->question_lang , 300) }}</p > 
					<p> {{ str_limit($d->answer_lang , 300) }}</p > 
					 <p><a href="{{ url("faq/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			