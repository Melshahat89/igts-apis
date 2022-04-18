@extends(layoutExtend('website'))

@section('title')
     {{ trans('quizstudentsstatus.quizstudentsstatus') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.quizstudentsstatus') }}</h1></div>
     <div><a href="{{ url('quizstudentsstatus/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.quizstudentsstatus') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="start_time" class="form-control datepicker2" placeholder="{{ trans("quizstudentsstatus.start_time") }}" value="{{ request()->has("start_time") ? request()->get("start_time") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="end_time" class="form-control datepicker2" placeholder="{{ trans("quizstudentsstatus.end_time") }}" value="{{ request()->has("end_time") ? request()->get("end_time") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="pause_time" class="form-control " placeholder="{{ trans("quizstudentsstatus.pause_time") }}" value="{{ request()->has("pause_time") ? request()->get("pause_time") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("quizstudentsstatus.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="skipped_question_id" class="form-control " placeholder="{{ trans("quizstudentsstatus.skipped_question_id") }}" value="{{ request()->has("skipped_question_id") ? request()->get("skipped_question_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="passed" class="form-control " placeholder="{{ trans("quizstudentsstatus.passed") }}" value="{{ request()->has("passed") ? request()->get("passed") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="exam_anytime" class="form-control " placeholder="{{ trans("quizstudentsstatus.exam_anytime") }}" value="{{ request()->has("exam_anytime") ? request()->get("exam_anytime") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("quizstudentsstatus") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("quizstudentsstatus.start_time") }}</th> 
				<th>{{ trans("quizstudentsstatus.edit") }}</th> 
				<th>{{ trans("quizstudentsstatus.show") }}</th> 
				<th>{{
            trans("quizstudentsstatus.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->start_time , 20) }}</td> 
				<td> @include("website.quizstudentsstatus.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.quizstudentsstatus.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.quizstudentsstatus.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
