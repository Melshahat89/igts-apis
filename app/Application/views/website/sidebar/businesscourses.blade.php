<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('businesscourses') }}</h2>
<hr>
@php $sidebarBusinesscourses = \App\Application\Model\Businesscourses::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBusinesscourses) > 0)
			@foreach ($sidebarBusinesscourses as $d)
				 <div>
					<p><a href="{{ url("businesscourses/".$d->id."/view") }}">{{ str_limit($d->comment , 20) }}</a></p > 
					<p><a href="{{ url("businesscourses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			