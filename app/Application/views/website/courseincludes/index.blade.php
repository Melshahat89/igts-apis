@extends(layoutExtend('website'))

@section('title')
     {{ trans('courseincludes.courseincludes') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.courseincludes') }}</h1></div>
     <div><a href="{{ url('courseincludes/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.courseincludes') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="position" class="form-control " placeholder="{{ trans("courseincludes.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("courseincludes") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("courseincludes.position") }}</th> 
				<th>{{ trans("courseincludes.edit") }}</th> 
				<th>{{ trans("courseincludes.show") }}</th> 
				<th>{{
            trans("courseincludes.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->position , 20) }}</td> 
				<td> @include("website.courseincludes.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.courseincludes.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.courseincludes.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
