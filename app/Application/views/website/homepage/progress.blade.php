<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('progress') }}</h2>
<hr>
@php $sidebarProgress = \App\Application\Model\Progress::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarProgress) > 0)
			@foreach ($sidebarProgress as $d)
				 <div>
					<h2 > {{ str_limit($d->percentage , 50) }}</h2 > 
					<p> {{ str_limit($d->note , 300) }}</p > 
					 <p><a href="{{ url("progress/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			