@extends(layoutExtend('website'))

@section('title')
     {{ trans('businessdata.businessdata') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.businessdata') }}</h1></div>
     <div><a href="{{ url('businessdata/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.businessdata') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("businessdata.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="discount_type" class="form-control " placeholder="{{ trans("businessdata.discount_type") }}" value="{{ request()->has("discount_type") ? request()->get("discount_type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="discount_value" class="form-control " placeholder="{{ trans("businessdata.discount_value") }}" value="{{ request()->has("discount_value") ? request()->get("discount_value") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="automatically_license" class="form-control select2" placeholder="{{ trans("businessdata.automatically_license") }}" > 
				<option value="1" {{ request()->has("automatically_license") && request()->get("automatically_license") === 1 ? "selected" : "" }}>{{trans("businessdata.Yes") }} </option> 
				<option value="0" {{request()->has("automatically_license") && request()->get("automatically_license") === 0 ? "selected" : "" }}>{{trans("businessdata.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("businessdata.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("businessdata") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("businessdata.name") }}</th> 
				<th>{{ trans("businessdata.edit") }}</th> 
				<th>{{ trans("businessdata.show") }}</th> 
				<th>{{
            trans("businessdata.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->name_lang , 20) }}</td> 
				<td> @include("website.businessdata.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.businessdata.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.businessdata.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
