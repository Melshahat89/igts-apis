@extends(layoutExtend('website'))

@section('title')
     {{ trans('orders.orders') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.orders') }}</h1></div>
     <div><a href="{{ url('orders/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.orders') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("orders.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="comments" class="form-control " placeholder="{{ trans("orders.comments") }}" value="{{ request()->has("comments") ? request()->get("comments") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="billing_address_id" class="form-control " placeholder="{{ trans("orders.billing_address_id") }}" value="{{ request()->has("billing_address_id") ? request()->get("billing_address_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_order_id" class="form-control " placeholder="{{ trans("orders.accept_order_id") }}" value="{{ request()->has("accept_order_id") ? request()->get("accept_order_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="kiosk_id" class="form-control " placeholder="{{ trans("orders.kiosk_id") }}" value="{{ request()->has("kiosk_id") ? request()->get("kiosk_id") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("orders") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("orders.status") }}</th> 
				<th>{{ trans("orders.edit") }}</th> 
				<th>{{ trans("orders.show") }}</th> 
				<th>{{
            trans("orders.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->status , 20) }}</td> 
				<td> @include("website.orders.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.orders.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.orders.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
