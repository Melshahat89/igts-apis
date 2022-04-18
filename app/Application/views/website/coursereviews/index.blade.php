@extends(layoutExtend('website'))

@section('title')
     {{ trans('coursereviews.coursereviews') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.coursereviews') }}</h1></div>
     <div><a href="{{ url('coursereviews/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.coursereviews') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="review" class="form-control " placeholder="{{ trans("coursereviews.review") }}" value="{{ request()->has("review") ? request()->get("review") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="rating" class="form-control " placeholder="{{ trans("coursereviews.rating") }}" value="{{ request()->has("rating") ? request()->get("rating") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="type" class="form-control select2" placeholder="{{ trans("coursereviews.type") }}" > 
				<option value="1" {{ request()->has("type") && request()->get("type") === 1 ? "selected" : "" }}>{{trans("coursereviews.Yes") }} </option> 
				<option value="0" {{request()->has("type") && request()->get("type") === 0 ? "selected" : "" }}>{{trans("coursereviews.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="manual_name" class="form-control " placeholder="{{ trans("coursereviews.manual_name") }}" value="{{ request()->has("manual_name") ? request()->get("manual_name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="manual_image" class="form-control " placeholder="{{ trans("coursereviews.manual_image") }}" value="{{ request()->has("manual_image") ? request()->get("manual_image") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("coursereviews") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("coursereviews.review") }}</th> 
				<th>{{ trans("coursereviews.edit") }}</th> 
				<th>{{ trans("coursereviews.show") }}</th> 
				<th>{{
            trans("coursereviews.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->review , 20) }}</td> 
				<td> @include("website.coursereviews.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.coursereviews.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.coursereviews.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
