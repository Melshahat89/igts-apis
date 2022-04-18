@extends(layoutExtend('website'))

@section('title')
     {{ trans('faq.faq') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.faq') }}</h1></div>
     <div><a href="{{ url('faq/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.faq') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="group_id" class="form-control " placeholder="{{ trans("faq.group_id") }}" value="{{ request()->has("group_id") ? request()->get("group_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="question" class="form-control " placeholder="{{ trans("faq.question") }}" value="{{ request()->has("question") ? request()->get("question") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="answer" class="form-control " placeholder="{{ trans("faq.answer") }}" value="{{ request()->has("answer") ? request()->get("answer") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("faq") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("faq.group_id") }}</th> 
				<th>{{ trans("faq.edit") }}</th> 
				<th>{{ trans("faq.show") }}</th> 
				<th>{{
            trans("faq.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->group_id , 20) }}</td> 
				<td> @include("website.faq.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.faq.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.faq.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
