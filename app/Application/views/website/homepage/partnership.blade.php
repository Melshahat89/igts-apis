<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('partnership') }}</h2>
<hr>
@php $sidebarPartnership = \App\Application\Model\Partnership::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarPartnership) > 0)
			@foreach ($sidebarPartnership as $d)
				 <div>
					<h2 > {{ str_limit($d->setting , 50) }}</h2 > 
					 <p><a href="{{ url("partnership/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			