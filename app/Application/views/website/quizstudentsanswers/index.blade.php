@extends(layoutExtend('website'))

@section('title')
     {{ trans('quizstudentsanswers.quizstudentsanswers') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.quizstudentsanswers') }}</h1></div>
     <div><a href="{{ url('quizstudentsanswers/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.quizstudentsanswers') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group" > 
			<select style="width:80px;" name="is_correct" class="form-control select2" placeholder="{{ trans("quizstudentsanswers.is_correct") }}" > 
				<option value="1" {{ request()->has("is_correct") && request()->get("is_correct") === 1 ? "selected" : "" }}>{{trans("quizstudentsanswers.Yes") }} </option> 
				<option value="0" {{request()->has("is_correct") && request()->get("is_correct") === 0 ? "selected" : "" }}>{{trans("quizstudentsanswers.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="answered" class="form-control select2" placeholder="{{ trans("quizstudentsanswers.answered") }}" > 
				<option value="1" {{ request()->has("answered") && request()->get("answered") === 1 ? "selected" : "" }}>{{trans("quizstudentsanswers.Yes") }} </option> 
				<option value="0" {{request()->has("answered") && request()->get("answered") === 0 ? "selected" : "" }}>{{trans("quizstudentsanswers.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="mark" class="form-control " placeholder="{{ trans("quizstudentsanswers.mark") }}" value="{{ request()->has("mark") ? request()->get("mark") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("quizstudentsanswers") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("quizstudentsanswers.is_correct") }}</th> 
				<th>{{ trans("quizstudentsanswers.edit") }}</th> 
				<th>{{ trans("quizstudentsanswers.show") }}</th> 
				<th>{{
            trans("quizstudentsanswers.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
				{{ $d->is_correct == 1 ? trans("quizstudentsanswers.Yes") : trans("quizstudentsanswers.No")  }}
					 </td> 
<td> @include("website.quizstudentsanswers.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.quizstudentsanswers.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.quizstudentsanswers.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
