<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('partners') }}</h2>
<hr>
@php $sidebarPartners = \App\Application\Model\Partners::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPartners) > 0)
			@foreach ($sidebarPartners as $d)
				 <div>
					<a href="{{ url("partners/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("partners/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			