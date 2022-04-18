@extends(layoutExtend('website'))

@section('title')
     {{ trans('events.events') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.events') }}</h1></div>
     <div><a href="{{ url('events/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.events') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("events.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("events.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="is_free" class="form-control select2" placeholder="{{ trans("events.is_free") }}" > 
				<option value="1" {{ request()->has("is_free") && request()->get("is_free") === 1 ? "selected" : "" }}>{{trans("events.Yes") }} </option> 
				<option value="0" {{request()->has("is_free") && request()->get("is_free") === 0 ? "selected" : "" }}>{{trans("events.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="price_egp" class="form-control " placeholder="{{ trans("events.price_egp") }}" value="{{ request()->has("price_egp") ? request()->get("price_egp") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="price_usd" class="form-control " placeholder="{{ trans("events.price_usd") }}" value="{{ request()->has("price_usd") ? request()->get("price_usd") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("events.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("events.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("events.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("events.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="location" class="form-control " placeholder="{{ trans("events.location") }}" value="{{ request()->has("location") ? request()->get("location") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="live_link" class="form-control " placeholder="{{ trans("events.live_link") }}" value="{{ request()->has("live_link") ? request()->get("live_link") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="recorded_link" class="form-control " placeholder="{{ trans("events.recorded_link") }}" value="{{ request()->has("recorded_link") ? request()->get("recorded_link") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("events") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("events.title") }}</th> 
				<th>{{ trans("events.edit") }}</th> 
				<th>{{ trans("events.show") }}</th> 
				<th>{{
            trans("events.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.events.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.events.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.events.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
