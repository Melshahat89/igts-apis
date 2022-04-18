<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('masterrequest') }}</h2>
<hr>
@php $sidebarMasterrequest = \App\Application\Model\Masterrequest::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarMasterrequest) > 0)
			@foreach ($sidebarMasterrequest as $d)
				 <div>
					 <img src="{{ small($d->qualification)}}"  width = "80" />
					<p><a href="{{ url("masterrequest/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			