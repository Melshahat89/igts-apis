@extends(layoutExtend('website'))

@section('title')
     {{ trans('categories.categories') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.categories') }}</h1></div>
     <div><a href="{{ url('categories/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.categories') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("categories.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("categories.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="desc" class="form-control " placeholder="{{ trans("categories.desc") }}" value="{{ request()->has("desc") ? request()->get("desc") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="parent_id" class="form-control " placeholder="{{ trans("categories.parent_id") }}" value="{{ request()->has("parent_id") ? request()->get("parent_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="sort" class="form-control " placeholder="{{ trans("categories.sort") }}" value="{{ request()->has("sort") ? request()->get("sort") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("categories.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("categories.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("categories.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="show_home" class="form-control select2" placeholder="{{ trans("categories.show_home") }}" > 
				<option value="1" {{ request()->has("show_home") && request()->get("show_home") === 1 ? "selected" : "" }}>{{trans("categories.Yes") }} </option> 
				<option value="0" {{request()->has("show_home") && request()->get("show_home") === 0 ? "selected" : "" }}>{{trans("categories.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="show_menu" class="form-control select2" placeholder="{{ trans("categories.show_menu") }}" > 
				<option value="1" {{ request()->has("show_menu") && request()->get("show_menu") === 1 ? "selected" : "" }}>{{trans("categories.Yes") }} </option> 
				<option value="0" {{request()->has("show_menu") && request()->get("show_menu") === 0 ? "selected" : "" }}>{{trans("categories.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("categories") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("categories.name") }}</th> 
				<th>{{ trans("categories.edit") }}</th> 
				<th>{{ trans("categories.show") }}</th> 
				<th>{{
            trans("categories.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->name_lang , 20) }}</td> 
				<td> @include("website.categories.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.categories.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.categories.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
