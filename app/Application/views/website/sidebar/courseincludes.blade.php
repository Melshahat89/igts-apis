<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('courseincludes') }}</h2>
<hr>
@php $sidebarCourseincludes = \App\Application\Model\Courseincludes::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCourseincludes) > 0)
			@foreach ($sidebarCourseincludes as $d)
				 <div>
					<p><a href="{{ url("courseincludes/".$d->id."/view") }}">{{ str_limit($d->position , 20) }}</a></p > 
					<p><a href="{{ url("courseincludes/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			