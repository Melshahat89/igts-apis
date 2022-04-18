<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('promotionusers') }}</h2>
<hr>
@php $sidebarPromotionusers = \App\Application\Model\Promotionusers::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarPromotionusers) > 0)
			@foreach ($sidebarPromotionusers as $d)
				 <div>
					{{ $d->used == 1 ? trans("promotionusers.Yes") : trans("promotionusers.No")  }}
					 <p><a href="{{ url("promotionusers/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			