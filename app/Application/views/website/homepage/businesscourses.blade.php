<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('businesscourses') }}</h2>
<hr>
@php $sidebarBusinesscourses = \App\Application\Model\Businesscourses::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBusinesscourses) > 0)
			@foreach ($sidebarBusinesscourses as $d)
				 <div>
					<h2 > {{ str_limit($d->comment , 50) }}</h2 > 
					<p> {{ str_limit($d->status , 300) }}</p > 
					 <p><a href="{{ url("businesscourses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			