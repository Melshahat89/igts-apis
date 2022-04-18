<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('lectures3d') }}</h2>
<hr>
@php $sidebarLectures3d = \App\Application\Model\Lectures3d::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarLectures3d) > 0)
			@foreach ($sidebarLectures3d as $d)
				 <div>
					<p><a href="{{ url("lectures3d/".$d->id."/view") }}">{{ str_limit($d->title , 20) }}</a></p > 
					<p><a href="{{ url("lectures3d/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			