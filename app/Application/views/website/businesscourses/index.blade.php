@extends(layoutExtend('website'))

@section('title')
     {{ trans('businesscourses.businesscourses') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.businesscourses') }}</h1></div>
     <div><a href="{{ url('businesscourses/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.businesscourses') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="comment" class="form-control " placeholder="{{ trans("businesscourses.comment") }}" value="{{ request()->has("comment") ? request()->get("comment") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="status" class="form-control " placeholder="{{ trans("businesscourses.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("businesscourses") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("businesscourses.comment") }}</th> 
				<th>{{ trans("businesscourses.edit") }}</th> 
				<th>{{ trans("businesscourses.show") }}</th> 
				<th>{{
            trans("businesscourses.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->comment , 20) }}</td> 
				<td> @include("website.businesscourses.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.businesscourses.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.businesscourses.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
