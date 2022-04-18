<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('courselectures') }}</h2>
<hr>
@php $sidebarCourselectures = \App\Application\Model\Courselectures::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCourselectures) > 0)
			@foreach ($sidebarCourselectures as $d)
				 <div>
					<h2 > {{ str_limit($d->title_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->slug , 300) }}</p > 
					<p> {{ str_limit($d->description_lang , 300) }}</p > 
					 <p><a href="{{ url("courselectures/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			