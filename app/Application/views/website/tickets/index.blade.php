@extends(layoutExtend('website'))

@section('title')
     {{ trans('tickets.tickets') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.tickets') }}</h1></div>
     <div><a href="{{ url('tickets/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.tickets') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="reciver_id" class="form-control " placeholder="{{ trans("tickets.reciver_id") }}" value="{{ request()->has("reciver_id") ? request()->get("reciver_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("tickets.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("tickets.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("tickets.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="message" class="form-control " placeholder="{{ trans("tickets.message") }}" value="{{ request()->has("message") ? request()->get("message") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="priority" class="form-control " placeholder="{{ trans("tickets.priority") }}" value="{{ request()->has("priority") ? request()->get("priority") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("tickets") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("tickets.reciver_id") }}</th> 
				<th>{{ trans("tickets.edit") }}</th> 
				<th>{{ trans("tickets.show") }}</th> 
				<th>{{
            trans("tickets.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->reciver_id , 20) }}</td> 
				<td> @include("website.tickets.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.tickets.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.tickets.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
