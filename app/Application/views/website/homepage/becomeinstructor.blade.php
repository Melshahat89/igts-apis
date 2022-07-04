<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('becomeinstructor') }}</h2>
<hr>
@php $sidebarBecomeInstructor = \App\Application\Model\BecomeInstructor::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBecomeInstructor) > 0)
			@foreach ($sidebarBecomeInstructor as $d)
				 <div>
					<h2 > {{ str_limit($d->name , 50) }}</h2 > 
					<p> {{ str_limit($d->email , 300) }}</p > 
					<p> {{ str_limit($d->phone , 300) }}</p > 
					 <p><a href="{{ url("becomeinstructor/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			