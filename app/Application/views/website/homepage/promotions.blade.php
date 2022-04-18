<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('promotions') }}</h2>
<hr>
@php $sidebarPromotions = \App\Application\Model\Promotions::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarPromotions) > 0)
			@foreach ($sidebarPromotions as $d)
				 <div>
					<h2 > {{ str_limit($d->title , 50) }}</h2 > 
					<p> {{ str_limit($d->description , 300) }}</p > 
					<p> {{ str_limit($d->type , 300) }}</p > 
					 <p><a href="{{ url("promotions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			