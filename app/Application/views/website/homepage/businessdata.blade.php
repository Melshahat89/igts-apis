<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('businessdata') }}</h2>
<hr>
@php $sidebarBusinessdata = \App\Application\Model\Businessdata::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBusinessdata) > 0)
			@foreach ($sidebarBusinessdata as $d)
				 <div>
					<h2 > {{ str_limit($d->name_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->discount_type , 300) }}</p > 
					<p> {{ str_limit($d->discount_value , 300) }}</p > 
					 <p><a href="{{ url("businessdata/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			