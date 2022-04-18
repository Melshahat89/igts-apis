<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('promotions') }}</h2>
<hr>
@php $sidebarPromotions = \App\Application\Model\Promotions::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPromotions) > 0)
			@foreach ($sidebarPromotions as $d)
				 <div>
					<p><a href="{{ url("promotions/".$d->id."/view") }}">{{ str_limit($d->title , 20) }}</a></p > 
					<p><a href="{{ url("promotions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			