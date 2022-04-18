<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('promotioncourses') }}</h2>
<hr>
@php $sidebarPromotioncourses = \App\Application\Model\Promotioncourses::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarPromotioncourses) > 0)
			@foreach ($sidebarPromotioncourses as $d)
				 <div>
					<h2 > {{ str_limit($d->note , 50) }}</h2 > 
					 <p><a href="{{ url("promotioncourses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			