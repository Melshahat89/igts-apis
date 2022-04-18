@extends(layoutExtend('website'))

@section('title')
     {{ trans('homesettings.homesettings') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.homesettings') }}</h1></div>
     <div><a href="{{ url('homesettings/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.homesettings') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group" > 
			<select style="width:80px;" name="bundles" class="form-control select2" placeholder="{{ trans("homesettings.bundles") }}" > 
				<option value="1" {{ request()->has("bundles") && request()->get("bundles") === 1 ? "selected" : "" }}>{{trans("homesettings.Yes") }} </option> 
				<option value="0" {{request()->has("bundles") && request()->get("bundles") === 0 ? "selected" : "" }}>{{trans("homesettings.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="featured_courses" class="form-control select2" placeholder="{{ trans("homesettings.featured_courses") }}" > 
				<option value="1" {{ request()->has("featured_courses") && request()->get("featured_courses") === 1 ? "selected" : "" }}>{{trans("homesettings.Yes") }} </option> 
				<option value="0" {{request()->has("featured_courses") && request()->get("featured_courses") === 0 ? "selected" : "" }}>{{trans("homesettings.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="events" class="form-control select2" placeholder="{{ trans("homesettings.events") }}" > 
				<option value="1" {{ request()->has("events") && request()->get("events") === 1 ? "selected" : "" }}>{{trans("homesettings.Yes") }} </option> 
				<option value="0" {{request()->has("events") && request()->get("events") === 0 ? "selected" : "" }}>{{trans("homesettings.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="talks" class="form-control select2" placeholder="{{ trans("homesettings.talks") }}" > 
				<option value="1" {{ request()->has("talks") && request()->get("talks") === 1 ? "selected" : "" }}>{{trans("homesettings.Yes") }} </option> 
				<option value="0" {{request()->has("talks") && request()->get("talks") === 0 ? "selected" : "" }}>{{trans("homesettings.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("homesettings") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("homesettings.bundles") }}</th> 
				<th>{{ trans("homesettings.edit") }}</th> 
				<th>{{ trans("homesettings.show") }}</th> 
				<th>{{
            trans("homesettings.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
				{{ $d->bundles == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					 </td> 
<td> @include("website.homesettings.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.homesettings.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.homesettings.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
