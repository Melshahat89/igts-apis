@extends(layoutExtend('website'))

@section('title')
     {{ trans('eventsenrollment.eventsenrollment') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.eventsenrollment') }}</h1></div>
     <div><a href="{{ url('eventsenrollment/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.eventsenrollment') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="start_time" class="form-control datepicker2" placeholder="{{ trans("eventsenrollment.start_time") }}" value="{{ request()->has("start_time") ? request()->get("start_time") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="end_time" class="form-control datepicker2" placeholder="{{ trans("eventsenrollment.end_time") }}" value="{{ request()->has("end_time") ? request()->get("end_time") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("eventsenrollment.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("eventsenrollment.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("eventsenrollment.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("eventsenrollment") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("eventsenrollment.start_time") }}</th> 
				<th>{{ trans("eventsenrollment.edit") }}</th> 
				<th>{{ trans("eventsenrollment.show") }}</th> 
				<th>{{
            trans("eventsenrollment.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->start_time , 20) }}</td> 
				<td> @include("website.eventsenrollment.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.eventsenrollment.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.eventsenrollment.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
