<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('businessgroupsusers') }}</h2>
<hr>
@php $sidebarBusinessgroupsusers = \App\Application\Model\Businessgroupsusers::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBusinessgroupsusers) > 0)
			@foreach ($sidebarBusinessgroupsusers as $d)
				 <div>
					{{ $d->status == 1 ? trans("businessgroupsusers.Yes") : trans("businessgroupsusers.No")  }}
					<p><a href="{{ url("businessgroupsusers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			