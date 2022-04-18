@extends(layoutExtend('website'))

@section('title')
     {{ trans('lecturequestions.lecturequestions') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.lecturequestions') }}</h1></div>
     <div><a href="{{ url('lecturequestions/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.lecturequestions') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="question_title" class="form-control " placeholder="{{ trans("lecturequestions.question_title") }}" value="{{ request()->has("question_title") ? request()->get("question_title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="question_description" class="form-control " placeholder="{{ trans("lecturequestions.question_description") }}" value="{{ request()->has("question_description") ? request()->get("question_description") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="approve" class="form-control select2" placeholder="{{ trans("lecturequestions.approve") }}" > 
				<option value="1" {{ request()->has("approve") && request()->get("approve") === 1 ? "selected" : "" }}>{{trans("lecturequestions.Yes") }} </option> 
				<option value="0" {{request()->has("approve") && request()->get("approve") === 0 ? "selected" : "" }}>{{trans("lecturequestions.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("lecturequestions") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("lecturequestions.question_title") }}</th> 
				<th>{{ trans("lecturequestions.edit") }}</th> 
				<th>{{ trans("lecturequestions.show") }}</th> 
				<th>{{
            trans("lecturequestions.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->question_title , 20) }}</td> 
				<td> @include("website.lecturequestions.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.lecturequestions.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.lecturequestions.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
