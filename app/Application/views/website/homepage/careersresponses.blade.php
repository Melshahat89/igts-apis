<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('careersresponses') }}</h2>
<hr>
@php $sidebarCareersresponses = \App\Application\Model\Careersresponses::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCareersresponses) > 0)
			@foreach ($sidebarCareersresponses as $d)
				 <div>
					<h2 > {{ str_limit($d->name , 50) }}</h2 > 
					<p> {{ str_limit($d->email , 300) }}</p > 
					<p> {{ str_limit($d->mobile , 300) }}</p > 
					 <p><a href="{{ url("careersresponses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			