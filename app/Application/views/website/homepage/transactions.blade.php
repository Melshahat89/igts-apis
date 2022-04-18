<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('transactions') }}</h2>
<hr>
@php $sidebarTransactions = \App\Application\Model\Transactions::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTransactions) > 0)
			@foreach ($sidebarTransactions as $d)
				 <div>
					<h2 > {{ str_limit($d->price , 50) }}</h2 > 
					<p> {{ str_limit($d->currency , 300) }}</p > 
					<p> {{ str_limit($d->percent , 300) }}</p > 
					 <p><a href="{{ url("transactions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			