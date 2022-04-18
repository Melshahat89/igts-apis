<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('eventsenrollment') }}</h2>
<hr>
@php $sidebarEventsenrollment = \App\Application\Model\Eventsenrollment::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarEventsenrollment) > 0)
			@foreach ($sidebarEventsenrollment as $d)
				 <div>
					<h2 > {{ str_limit($d->start_time , 50) }}</h2 > 
					<p> {{ str_limit($d->end_time , 300) }}</p > 
					{{ $d->status == 1 ? trans("eventsenrollment.Yes") : trans("eventsenrollment.No")  }}
					 <p><a href="{{ url("eventsenrollment/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			