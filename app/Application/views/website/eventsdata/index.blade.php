@extends(layoutExtend('website'))

@section('title')
     {{ trans('eventsdata.eventsdata') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.eventsdata') }}</h1></div>
     <div><a href="{{ url('eventsdata/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.eventsdata') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("eventsdata.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="email" class="form-control " placeholder="{{ trans("eventsdata.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="website" class="form-control " placeholder="{{ trans("eventsdata.website") }}" value="{{ request()->has("website") ? request()->get("website") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="about" class="form-control " placeholder="{{ trans("eventsdata.about") }}" value="{{ request()->has("about") ? request()->get("about") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("eventsdata.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("eventsdata.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("eventsdata.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("eventsdata") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("eventsdata.name") }}</th> 
				<th>{{ trans("eventsdata.edit") }}</th> 
				<th>{{ trans("eventsdata.show") }}</th> 
				<th>{{
            trans("eventsdata.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->name_lang , 20) }}</td> 
				<td> @include("website.eventsdata.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.eventsdata.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.eventsdata.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
