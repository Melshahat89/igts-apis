@extends(layoutExtend('website'))

@section('title')
     {{ trans('talksreviews.talksreviews') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.talksreviews') }}</h1></div>
     <div><a href="{{ url('talksreviews/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.talksreviews') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="review" class="form-control " placeholder="{{ trans("talksreviews.review") }}" value="{{ request()->has("review") ? request()->get("review") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="rating" class="form-control " placeholder="{{ trans("talksreviews.rating") }}" value="{{ request()->has("rating") ? request()->get("rating") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("talksreviews") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("talksreviews.review") }}</th> 
				<th>{{ trans("talksreviews.edit") }}</th> 
				<th>{{ trans("talksreviews.show") }}</th> 
				<th>{{
            trans("talksreviews.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->review , 20) }}</td> 
				<td> @include("website.talksreviews.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.talksreviews.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.talksreviews.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
