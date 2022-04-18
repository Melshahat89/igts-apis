<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('coursewishlist') }}</h2>
<hr>
@php $sidebarCoursewishlist = \App\Application\Model\Coursewishlist::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarCoursewishlist) > 0)
			@foreach ($sidebarCoursewishlist as $d)
				 <div>
					<p><a href="{{ url("coursewishlist/".$d->id."/view") }}">{{ str_limit($d->note , 20) }}</a></p > 
					<p><a href="{{ url("coursewishlist/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			