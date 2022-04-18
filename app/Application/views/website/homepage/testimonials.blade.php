<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('testimonials') }}</h2>
<hr>
@php $sidebarTestimonials = \App\Application\Model\Testimonials::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTestimonials) > 0)
			@foreach ($sidebarTestimonials as $d)
				 <div>
					<h2 > {{ str_limit($d->name_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->title_lang , 300) }}</p > 
					<p> {{ str_limit($d->message_lang , 300) }}</p > 
					 <p><a href="{{ url("testimonials/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			