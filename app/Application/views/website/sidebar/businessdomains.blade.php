<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('businessdomains') }}</h2>
<hr>
@php $sidebarBusinessdomains = \App\Application\Model\Businessdomains::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarBusinessdomains) > 0)
			@foreach ($sidebarBusinessdomains as $d)
				 <div>
					<p><a href="{{ url("businessdomains/".$d->id."/view") }}">{{ str_limit($d->domainname , 20) }}</a></p > 
					<p><a href="{{ url("businessdomains/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			