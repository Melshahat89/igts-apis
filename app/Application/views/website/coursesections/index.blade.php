@extends(layoutExtend('website'))

@section('title')
     {{ trans('coursesections.coursesections') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.coursesections') }}</h1></div>
     <div><a href="{{ url('coursesections/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.coursesections') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("coursesections.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="will_do_at_the_end" class="form-control " placeholder="{{ trans("coursesections.will_do_at_the_end") }}" value="{{ request()->has("will_do_at_the_end") ? request()->get("will_do_at_the_end") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="position" class="form-control " placeholder="{{ trans("coursesections.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("coursesections") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("coursesections.title") }}</th> 
				<th>{{ trans("coursesections.edit") }}</th> 
				<th>{{ trans("coursesections.show") }}</th> 
				<th>{{
            trans("coursesections.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.coursesections.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.coursesections.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.coursesections.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
