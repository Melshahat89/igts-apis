<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('testimonials') }}</h2>
<hr>
@php $sidebarTestimonials = \App\Application\Model\Testimonials::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTestimonials) > 0)
			@foreach ($sidebarTestimonials as $d)
				 <div>
					<a href="{{ url("testimonials/".$d->id."/view") }}" ><p>{{ str_limit($d->name_lang , 20) }}</a></p > 
					<p><a href="{{ url("testimonials/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			