<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('talklikes') }}</h2>
<hr>
@php $sidebarTalklikes = \App\Application\Model\Talklikes::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTalklikes) > 0)
			@foreach ($sidebarTalklikes as $d)
				 <div>
					<h2 > {{ str_limit($d->comment , 50) }}</h2 > 
					{{ $d->status == 1 ? trans("talklikes.Yes") : trans("talklikes.No")  }}
					 <p><a href="{{ url("talklikes/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			