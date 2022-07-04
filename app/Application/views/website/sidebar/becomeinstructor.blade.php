<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('becomeinstructor') }}</h2>
<hr>
@php $sidebarBecomeInstructor = \App\Application\Model\BecomeInstructor::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBecomeInstructor) > 0)
			@foreach ($sidebarBecomeInstructor as $d)
				 <div>
					<p><a href="{{ url("becomeinstructor/".$d->id."/view") }}">{{ str_limit($d->name , 20) }}</a></p > 
					<p><a href="{{ url("becomeinstructor/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			