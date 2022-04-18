@extends(layoutExtend('website'))

@section('title')
     {{ trans('quiz.quiz') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.quiz') }}</h1></div>
     <div><a href="{{ url('quiz/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.quiz') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("quiz.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("quiz.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="instructions" class="form-control " placeholder="{{ trans("quiz.instructions") }}" value="{{ request()->has("instructions") ? request()->get("instructions") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="time" class="form-control time" placeholder="{{ trans("quiz.time") }}" value="{{ request()->has("time") ? request()->get("time") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="time_in_mins" class="form-control " placeholder="{{ trans("quiz.time_in_mins") }}" value="{{ request()->has("time_in_mins") ? request()->get("time_in_mins") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("quiz.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="pass_percentage" class="form-control " placeholder="{{ trans("quiz.pass_percentage") }}" value="{{ request()->has("pass_percentage") ? request()->get("pass_percentage") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("quiz") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("quiz.title") }}</th> 
				<th>{{ trans("quiz.edit") }}</th> 
				<th>{{ trans("quiz.show") }}</th> 
				<th>{{
            trans("quiz.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.quiz.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.quiz.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.quiz.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
