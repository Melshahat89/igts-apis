<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courselectures') }}</h2>
<hr>
@php $sidebarCourselectures = \App\Application\Model\Courselectures::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourselectures) > 0)
			@foreach ($sidebarCourselectures as $d)
				 <div>
					<a href="{{ url("courselectures/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("courselectures/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			