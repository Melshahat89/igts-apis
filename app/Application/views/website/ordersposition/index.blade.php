@extends(layoutExtend('website'))

@section('title')
     {{ trans('ordersposition.ordersposition') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.ordersposition') }}</h1></div>
     <div><a href="{{ url('ordersposition/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.ordersposition') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="amount" class="form-control " placeholder="{{ trans("ordersposition.amount") }}" value="{{ request()->has("amount") ? request()->get("amount") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="notes" class="form-control " placeholder="{{ trans("ordersposition.notes") }}" value="{{ request()->has("notes") ? request()->get("notes") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="certificate_id" class="form-control " placeholder="{{ trans("ordersposition.certificate_id") }}" value="{{ request()->has("certificate_id") ? request()->get("certificate_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="shipping_id" class="form-control " placeholder="{{ trans("ordersposition.shipping_id") }}" value="{{ request()->has("shipping_id") ? request()->get("shipping_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("ordersposition.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("ordersposition") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("ordersposition.amount") }}</th> 
				<th>{{ trans("ordersposition.edit") }}</th> 
				<th>{{ trans("ordersposition.show") }}</th> 
				<th>{{
            trans("ordersposition.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->amount , 20) }}</td> 
				<td> @include("website.ordersposition.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.ordersposition.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.ordersposition.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
