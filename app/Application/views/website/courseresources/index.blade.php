@extends(layoutExtend('website'))

@section('title')
     {{ trans('courseresources.courseresources') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.courseresources') }}</h1></div>
     <div><a href="{{ url('courseresources/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.courseresources') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("courseresources.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("courseresources") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("courseresources.title") }}</th> 
				<th>{{ trans("courseresources.edit") }}</th> 
				<th>{{ trans("courseresources.show") }}</th> 
				<th>{{
            trans("courseresources.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.courseresources.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.courseresources.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.courseresources.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
