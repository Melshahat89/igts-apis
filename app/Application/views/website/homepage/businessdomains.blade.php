<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('businessdomains') }}</h2>
<hr>
@php $sidebarBusinessdomains = \App\Application\Model\Businessdomains::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarBusinessdomains) > 0)
			@foreach ($sidebarBusinessdomains as $d)
				 <div>
					<h2 > {{ str_limit($d->domainname , 50) }}</h2 > 
					{{ $d->status == 1 ? trans("businessdomains.Yes") : trans("businessdomains.No")  }}
					 <p><a href="{{ url("businessdomains/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			