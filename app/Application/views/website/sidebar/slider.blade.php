<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('slider') }}</h2>
<hr>
@php $sidebarSlider = \App\Application\Model\Slider::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarSlider) > 0)
			@foreach ($sidebarSlider as $d)
				 <div>
					<a href="{{ url("slider/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("slider/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			