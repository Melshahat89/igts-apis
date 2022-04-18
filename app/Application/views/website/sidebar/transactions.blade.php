<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('transactions') }}</h2>
<hr>
@php $sidebarTransactions = \App\Application\Model\Transactions::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTransactions) > 0)
			@foreach ($sidebarTransactions as $d)
				 <div>
					<p><a href="{{ url("transactions/".$d->id."/view") }}">{{ str_limit($d->price , 20) }}</a></p > 
					<p><a href="{{ url("transactions/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			