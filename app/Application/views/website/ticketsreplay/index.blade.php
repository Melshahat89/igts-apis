@extends(layoutExtend('website'))

@section('title')
     {{ trans('ticketsreplay.ticketsreplay') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.ticketsreplay') }}</h1></div>
     <div><a href="{{ url('ticketsreplay/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.ticketsreplay') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="message" class="form-control " placeholder="{{ trans("ticketsreplay.message") }}" value="{{ request()->has("message") ? request()->get("message") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="reciver_id" class="form-control " placeholder="{{ trans("ticketsreplay.reciver_id") }}" value="{{ request()->has("reciver_id") ? request()->get("reciver_id") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("ticketsreplay") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("ticketsreplay.message") }}</th> 
				<th>{{ trans("ticketsreplay.edit") }}</th> 
				<th>{{ trans("ticketsreplay.show") }}</th> 
				<th>{{
            trans("ticketsreplay.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->message , 20) }}</td> 
				<td> @include("website.ticketsreplay.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.ticketsreplay.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.ticketsreplay.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
