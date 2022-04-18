@extends(layoutExtend('website'))

@section('title')
     {{ trans('progress.progress') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.progress') }}</h1></div>
     <div><a href="{{ url('progress/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.progress') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="percentage" class="form-control " placeholder="{{ trans("progress.percentage") }}" value="{{ request()->has("percentage") ? request()->get("percentage") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="note" class="form-control " placeholder="{{ trans("progress.note") }}" value="{{ request()->has("note") ? request()->get("note") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("progress") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("progress.percentage") }}</th> 
				<th>{{ trans("progress.edit") }}</th> 
				<th>{{ trans("progress.show") }}</th> 
				<th>{{
            trans("progress.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->percentage , 20) }}</td> 
				<td> @include("website.progress.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.progress.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.progress.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
