@extends(layoutExtend('website'))

@section('title')
     {{ trans('talks.talks') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.talks') }}</h1></div>
     <div><a href="{{ url('talks/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.talks') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("talks.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("talks.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="subtitle" class="form-control " placeholder="{{ trans("talks.subtitle") }}" value="{{ request()->has("subtitle") ? request()->get("subtitle") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("talks.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="language_id" class="form-control " placeholder="{{ trans("talks.language_id") }}" value="{{ request()->has("language_id") ? request()->get("language_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="length" class="form-control " placeholder="{{ trans("talks.length") }}" value="{{ request()->has("length") ? request()->get("length") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="featured" class="form-control select2" placeholder="{{ trans("talks.featured") }}" > 
				<option value="1" {{ request()->has("featured") && request()->get("featured") === 1 ? "selected" : "" }}>{{trans("talks.Yes") }} </option> 
				<option value="0" {{request()->has("featured") && request()->get("featured") === 0 ? "selected" : "" }}>{{trans("talks.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="published" class="form-control select2" placeholder="{{ trans("talks.published") }}" > 
				<option value="1" {{ request()->has("published") && request()->get("published") === 1 ? "selected" : "" }}>{{trans("talks.Yes") }} </option> 
				<option value="0" {{request()->has("published") && request()->get("published") === 0 ? "selected" : "" }}>{{trans("talks.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="visits" class="form-control " placeholder="{{ trans("talks.visits") }}" value="{{ request()->has("visits") ? request()->get("visits") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="video_file" class="form-control " placeholder="{{ trans("talks.video_file") }}" value="{{ request()->has("video_file") ? request()->get("video_file") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="sort" class="form-control " placeholder="{{ trans("talks.sort") }}" value="{{ request()->has("sort") ? request()->get("sort") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="doctor_name" class="form-control " placeholder="{{ trans("talks.doctor_name") }}" value="{{ request()->has("doctor_name") ? request()->get("doctor_name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="seo_desc" class="form-control " placeholder="{{ trans("talks.seo_desc") }}" value="{{ request()->has("seo_desc") ? request()->get("seo_desc") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="seo_keys" class="form-control " placeholder="{{ trans("talks.seo_keys") }}" value="{{ request()->has("seo_keys") ? request()->get("seo_keys") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="search_keys" class="form-control " placeholder="{{ trans("talks.search_keys") }}" value="{{ request()->has("search_keys") ? request()->get("search_keys") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("talks") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("talks.title") }}</th> 
				<th>{{ trans("talks.edit") }}</th> 
				<th>{{ trans("talks.show") }}</th> 
				<th>{{
            trans("talks.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.talks.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.talks.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.talks.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
