<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('masterrequest') }}</h2>
<hr>
@php $sidebarMasterrequest = \App\Application\Model\Masterrequest::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarMasterrequest) > 0)
			@foreach ($sidebarMasterrequest as $d)
				 <div>
					 <img src="{{ small($d->qualification)}}"  width = "80" />
					<p> {{ str_limit($d->collage_name , 300) }}</p > 
					<p> {{ str_limit($d->section , 300) }}</p > 
					 <p><a href="{{ url("masterrequest/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			