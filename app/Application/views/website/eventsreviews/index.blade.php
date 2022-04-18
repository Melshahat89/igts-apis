@extends(layoutExtend('website'))

@section('title')
     {{ trans('eventsreviews.eventsreviews') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.eventsreviews') }}</h1></div>
     <div><a href="{{ url('eventsreviews/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.eventsreviews') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="review" class="form-control " placeholder="{{ trans("eventsreviews.review") }}" value="{{ request()->has("review") ? request()->get("review") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="rating" class="form-control " placeholder="{{ trans("eventsreviews.rating") }}" value="{{ request()->has("rating") ? request()->get("rating") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("eventsreviews") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("eventsreviews.review") }}</th> 
				<th>{{ trans("eventsreviews.edit") }}</th> 
				<th>{{ trans("eventsreviews.show") }}</th> 
				<th>{{
            trans("eventsreviews.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->review , 20) }}</td> 
				<td> @include("website.eventsreviews.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.eventsreviews.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.eventsreviews.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
