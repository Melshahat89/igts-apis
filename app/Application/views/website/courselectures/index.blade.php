@extends(layoutExtend('website'))

@section('title')
     {{ trans('courselectures.courselectures') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.courselectures') }}</h1></div>
     <div><a href="{{ url('courselectures/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.courselectures') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("courselectures.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="slug" class="form-control " placeholder="{{ trans("courselectures.slug") }}" value="{{ request()->has("slug") ? request()->get("slug") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("courselectures.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="video_file" class="form-control " placeholder="{{ trans("courselectures.video_file") }}" value="{{ request()->has("video_file") ? request()->get("video_file") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="length" class="form-control " placeholder="{{ trans("courselectures.length") }}" value="{{ request()->has("length") ? request()->get("length") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="is_free" class="form-control select2" placeholder="{{ trans("courselectures.is_free") }}" > 
				<option value="1" {{ request()->has("is_free") && request()->get("is_free") === 1 ? "selected" : "" }}>{{trans("courselectures.Yes") }} </option> 
				<option value="0" {{request()->has("is_free") && request()->get("is_free") === 0 ? "selected" : "" }}>{{trans("courselectures.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="position" class="form-control " placeholder="{{ trans("courselectures.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("courselectures") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("courselectures.title") }}</th> 
				<th>{{ trans("courselectures.edit") }}</th> 
				<th>{{ trans("courselectures.show") }}</th> 
				<th>{{
            trans("courselectures.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.courselectures.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.courselectures.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.courselectures.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
