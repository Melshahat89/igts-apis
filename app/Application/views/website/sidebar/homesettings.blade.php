<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('homesettings') }}</h2>
<hr>
@php $sidebarHomesettings = \App\Application\Model\Homesettings::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarHomesettings) > 0)
			@foreach ($sidebarHomesettings as $d)
				 <div>
					{{ $d->bundles == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					<p><a href="{{ url("homesettings/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			