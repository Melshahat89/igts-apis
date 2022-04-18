<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('slider') }}</h2>
<hr>
@php $sidebarSlider = \App\Application\Model\Slider::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarSlider) > 0)
			@foreach ($sidebarSlider as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->description_lang , 300) }}</p > 
					 <img src="{{ small($d->image_m_ar)}}"  width = "80" />
					 <p><a href="{{ url("slider/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			