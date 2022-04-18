<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('coursewishlist') }}</h2>
<hr>
@php $sidebarCoursewishlist = \App\Application\Model\Coursewishlist::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarCoursewishlist) > 0)
			@foreach ($sidebarCoursewishlist as $d)
				 <div>
					<h2 > {{ str_limit($d->note , 50) }}</h2 > 
					 <p><a href="{{ url("coursewishlist/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			