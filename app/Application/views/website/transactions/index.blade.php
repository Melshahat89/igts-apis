@extends(layoutExtend('website'))

@section('title')
     {{ trans('transactions.transactions') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.transactions') }}</h1></div>
     <div><a href="{{ url('transactions/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.transactions') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="price" class="form-control " placeholder="{{ trans("transactions.price") }}" value="{{ request()->has("price") ? request()->get("price") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="currency" class="form-control " placeholder="{{ trans("transactions.currency") }}" value="{{ request()->has("currency") ? request()->get("currency") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="percent" class="form-control " placeholder="{{ trans("transactions.percent") }}" value="{{ request()->has("percent") ? request()->get("percent") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="amount" class="form-control " placeholder="{{ trans("transactions.amount") }}" value="{{ request()->has("amount") ? request()->get("amount") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("transactions.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="date" class="form-control datepicker2" placeholder="{{ trans("transactions.date") }}" value="{{ request()->has("date") ? request()->get("date") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("transactions") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("transactions.price") }}</th> 
				<th>{{ trans("transactions.edit") }}</th> 
				<th>{{ trans("transactions.show") }}</th> 
				<th>{{
            trans("transactions.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->price , 20) }}</td> 
				<td> @include("website.transactions.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.transactions.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.transactions.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
