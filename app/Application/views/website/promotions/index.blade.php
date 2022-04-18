@extends(layoutExtend('website'))

@section('title')
     {{ trans('promotions.promotions') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.promotions') }}</h1></div>
     <div><a href="{{ url('promotions/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.promotions') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("promotions.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("promotions.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("promotions.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="value_for_egp" class="form-control " placeholder="{{ trans("promotions.value_for_egp") }}" value="{{ request()->has("value_for_egp") ? request()->get("value_for_egp") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="value_for_other_currencies" class="form-control " placeholder="{{ trans("promotions.value_for_other_currencies") }}" value="{{ request()->has("value_for_other_currencies") ? request()->get("value_for_other_currencies") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="code" class="form-control " placeholder="{{ trans("promotions.code") }}" value="{{ request()->has("code") ? request()->get("code") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="start_date" class="form-control datepicker2" placeholder="{{ trans("promotions.start_date") }}" value="{{ request()->has("start_date") ? request()->get("start_date") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="expiration_date" class="form-control " placeholder="{{ trans("promotions.expiration_date") }}" value="{{ request()->has("expiration_date") ? request()->get("expiration_date") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="active" class="form-control select2" placeholder="{{ trans("promotions.active") }}" > 
				<option value="1" {{ request()->has("active") && request()->get("active") === 1 ? "selected" : "" }}>{{trans("promotions.Yes") }} </option> 
				<option value="0" {{request()->has("active") && request()->get("active") === 0 ? "selected" : "" }}>{{trans("promotions.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="promotion_limit" class="form-control " placeholder="{{ trans("promotions.promotion_limit") }}" value="{{ request()->has("promotion_limit") ? request()->get("promotion_limit") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="promotion_usage" class="form-control " placeholder="{{ trans("promotions.promotion_usage") }}" value="{{ request()->has("promotion_usage") ? request()->get("promotion_usage") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="publish_as_notification" class="form-control select2" placeholder="{{ trans("promotions.publish_as_notification") }}" > 
				<option value="1" {{ request()->has("publish_as_notification") && request()->get("publish_as_notification") === 1 ? "selected" : "" }}>{{trans("promotions.Yes") }} </option> 
				<option value="0" {{request()->has("publish_as_notification") && request()->get("publish_as_notification") === 0 ? "selected" : "" }}>{{trans("promotions.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="notification_message" class="form-control " placeholder="{{ trans("promotions.notification_message") }}" value="{{ request()->has("notification_message") ? request()->get("notification_message") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="include_courses" class="form-control select2" placeholder="{{ trans("promotions.include_courses") }}" > 
				<option value="1" {{ request()->has("include_courses") && request()->get("include_courses") === 1 ? "selected" : "" }}>{{trans("promotions.Yes") }} </option> 
				<option value="0" {{request()->has("include_courses") && request()->get("include_courses") === 0 ? "selected" : "" }}>{{trans("promotions.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("promotions") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("promotions.title") }}</th> 
				<th>{{ trans("promotions.edit") }}</th> 
				<th>{{ trans("promotions.show") }}</th> 
				<th>{{
            trans("promotions.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->title , 20) }}</td> 
				<td> @include("website.promotions.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.promotions.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.promotions.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
