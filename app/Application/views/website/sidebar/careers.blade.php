<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('careers') }}</h2>
<hr>
@php $sidebarCareers = \App\Application\Model\Careers::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCareers) > 0)
			@foreach ($sidebarCareers as $d)
				 <div>
					<a href="{{ url("careers/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("careers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			