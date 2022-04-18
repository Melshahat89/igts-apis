@extends(layoutExtend('website'))

@section('title')
     {{ trans('payments.payments') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.payments') }}</h1></div>
     <div><a href="{{ url('payments/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.payments') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="operation" class="form-control " placeholder="{{ trans("payments.operation") }}" value="{{ request()->has("operation") ? request()->get("operation") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="amount" class="form-control " placeholder="{{ trans("payments.amount") }}" value="{{ request()->has("amount") ? request()->get("amount") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="currency_id" class="form-control " placeholder="{{ trans("payments.currency_id") }}" value="{{ request()->has("currency_id") ? request()->get("currency_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="receiver_id" class="form-control " placeholder="{{ trans("payments.receiver_id") }}" value="{{ request()->has("receiver_id") ? request()->get("receiver_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="token" class="form-control " placeholder="{{ trans("payments.token") }}" value="{{ request()->has("token") ? request()->get("token") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="token_date" class="form-control " placeholder="{{ trans("payments.token_date") }}" value="{{ request()->has("token_date") ? request()->get("token_date") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("payments.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_source_data_type" class="form-control " placeholder="{{ trans("payments.accept_source_data_type") }}" value="{{ request()->has("accept_source_data_type") ? request()->get("accept_source_data_type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_id" class="form-control " placeholder="{{ trans("payments.accept_id") }}" value="{{ request()->has("accept_id") ? request()->get("accept_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_pending" class="form-control " placeholder="{{ trans("payments.accept_pending") }}" value="{{ request()->has("accept_pending") ? request()->get("accept_pending") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_order" class="form-control " placeholder="{{ trans("payments.accept_order") }}" value="{{ request()->has("accept_order") ? request()->get("accept_order") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_amount_cents" class="form-control " placeholder="{{ trans("payments.accept_amount_cents") }}" value="{{ request()->has("accept_amount_cents") ? request()->get("accept_amount_cents") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_success" class="form-control " placeholder="{{ trans("payments.accept_success") }}" value="{{ request()->has("accept_success") ? request()->get("accept_success") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_data_message" class="form-control " placeholder="{{ trans("payments.accept_data_message") }}" value="{{ request()->has("accept_data_message") ? request()->get("accept_data_message") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_profile_id" class="form-control " placeholder="{{ trans("payments.accept_profile_id") }}" value="{{ request()->has("accept_profile_id") ? request()->get("accept_profile_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_source_data_sub_type" class="form-control " placeholder="{{ trans("payments.accept_source_data_sub_type") }}" value="{{ request()->has("accept_source_data_sub_type") ? request()->get("accept_source_data_sub_type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="accept_hmac" class="form-control " placeholder="{{ trans("payments.accept_hmac") }}" value="{{ request()->has("accept_hmac") ? request()->get("accept_hmac") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="txn_response_code" class="form-control " placeholder="{{ trans("payments.txn_response_code") }}" value="{{ request()->has("txn_response_code") ? request()->get("txn_response_code") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("payments") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("payments.operation") }}</th> 
				<th>{{ trans("payments.edit") }}</th> 
				<th>{{ trans("payments.show") }}</th> 
				<th>{{
            trans("payments.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->operation , 20) }}</td> 
				<td> @include("website.payments.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.payments.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.payments.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
