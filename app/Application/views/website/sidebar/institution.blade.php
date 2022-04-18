<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('institution') }}</h2>
<hr>
@php $sidebarInstitution = \App\Application\Model\Institution::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarInstitution) > 0)
			@foreach ($sidebarInstitution as $d)
				 <div>
					<p><a href="{{ url("institution/".$d->id."/view") }}">{{ str_limit($d->temp1 , 20) }}</a></p > 
					<p><a href="{{ url("institution/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			