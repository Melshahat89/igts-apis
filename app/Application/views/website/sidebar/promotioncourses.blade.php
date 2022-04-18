<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('promotioncourses') }}</h2>
<hr>
@php $sidebarPromotioncourses = \App\Application\Model\Promotioncourses::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPromotioncourses) > 0)
			@foreach ($sidebarPromotioncourses as $d)
				 <div>
					<p><a href="{{ url("promotioncourses/".$d->id."/view") }}">{{ str_limit($d->note , 20) }}</a></p > 
					<p><a href="{{ url("promotioncourses/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			