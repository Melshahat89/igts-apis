<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('promotionactive') }}</h2>
<hr>
@php $sidebarPromotionactive = \App\Application\Model\Promotionactive::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarPromotionactive) > 0)
			@foreach ($sidebarPromotionactive as $d)
				 <div>
					{{ $d->status == 1 ? trans("promotionactive.Yes") : trans("promotionactive.No")  }}
					<p><a href="{{ url("promotionactive/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			