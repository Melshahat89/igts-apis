@extends(layoutExtend('website'))

@section('title')
     {{ trans('quizquestions.quizquestions') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.quizquestions') }}</h1></div>
     <div><a href="{{ url('quizquestions/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.quizquestions') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="question" class="form-control " placeholder="{{ trans("quizquestions.question") }}" value="{{ request()->has("question") ? request()->get("question") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="type" class="form-control " placeholder="{{ trans("quizquestions.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="mark" class="form-control " placeholder="{{ trans("quizquestions.mark") }}" value="{{ request()->has("mark") ? request()->get("mark") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("quizquestions") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("quizquestions.question") }}</th> 
				<th>{{ trans("quizquestions.edit") }}</th> 
				<th>{{ trans("quizquestions.show") }}</th> 
				<th>{{
            trans("quizquestions.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->question_lang , 20) }}</td> 
				<td> @include("website.quizquestions.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.quizquestions.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.quizquestions.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
