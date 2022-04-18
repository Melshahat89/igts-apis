@extends(layoutExtend('website'))

@section('title')
     {{ trans('lecturequestionsanswers.lecturequestionsanswers') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.lecturequestionsanswers') }}</h1></div>
     <div><a href="{{ url('lecturequestionsanswers/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.lecturequestionsanswers') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="answer" class="form-control " placeholder="{{ trans("lecturequestionsanswers.answer") }}" value="{{ request()->has("answer") ? request()->get("answer") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("lecturequestionsanswers") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("lecturequestionsanswers.answer") }}</th> 
				<th>{{ trans("lecturequestionsanswers.edit") }}</th> 
				<th>{{ trans("lecturequestionsanswers.show") }}</th> 
				<th>{{
            trans("lecturequestionsanswers.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->answer , 20) }}</td> 
				<td> @include("website.lecturequestionsanswers.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.lecturequestionsanswers.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.lecturequestionsanswers.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
