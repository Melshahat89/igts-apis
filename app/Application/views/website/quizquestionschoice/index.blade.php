@extends(layoutExtend('website'))

@section('title')
     {{ trans('quizquestionschoice.quizquestionschoice') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.quizquestionschoice') }}</h1></div>
     <div><a href="{{ url('quizquestionschoice/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.quizquestionschoice') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="choice" class="form-control " placeholder="{{ trans("quizquestionschoice.choice") }}" value="{{ request()->has("choice") ? request()->get("choice") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="is_correct" class="form-control select2" placeholder="{{ trans("quizquestionschoice.is_correct") }}" > 
				<option value="1" {{ request()->has("is_correct") && request()->get("is_correct") === 1 ? "selected" : "" }}>{{trans("quizquestionschoice.Yes") }} </option> 
				<option value="0" {{request()->has("is_correct") && request()->get("is_correct") === 0 ? "selected" : "" }}>{{trans("quizquestionschoice.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("quizquestionschoice") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("quizquestionschoice.choice") }}</th> 
				<th>{{ trans("quizquestionschoice.edit") }}</th> 
				<th>{{ trans("quizquestionschoice.show") }}</th> 
				<th>{{
            trans("quizquestionschoice.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->choice_lang , 20) }}</td> 
				<td> @include("website.quizquestionschoice.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.quizquestionschoice.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.quizquestionschoice.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
