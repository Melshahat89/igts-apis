<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('payments') }}</h2>
<hr>
@php $sidebarPayments = \App\Application\Model\Payments::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarPayments) > 0)
			@foreach ($sidebarPayments as $d)
				 <div>
					<h2 > {{ str_limit($d->operation , 50) }}</h2 > 
					<p> {{ str_limit($d->amount , 300) }}</p > 
					<p> {{ str_limit($d->currency_id , 300) }}</p > 
					 <p><a href="{{ url("payments/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			