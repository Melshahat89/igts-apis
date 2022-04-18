<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('businessgroupsusers') }}</h2>
<hr>
@php $sidebarBusinessgroupsusers = \App\Application\Model\Businessgroupsusers::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBusinessgroupsusers) > 0)
			@foreach ($sidebarBusinessgroupsusers as $d)
				 <div>
					{{ $d->status == 1 ? trans("businessgroupsusers.Yes") : trans("businessgroupsusers.No")  }}
					<p> {{ str_limit($d->note , 300) }}</p > 
					 <p><a href="{{ url("businessgroupsusers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			