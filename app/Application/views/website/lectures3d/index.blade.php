@extends(layoutExtend('website'))

@section('title')
     {{ trans('lectures3d.lectures3d') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.lectures3d') }}</h1></div>
     <div><a href="{{ url('lectures3d/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.lectures3d') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("lectures3d.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="link" class="form-control " placeholder="{{ trans("lectures3d.link") }}" value="{{ request()->has("link") ? request()->get("link") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("lectures3d") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("lectures3d.title") }}</th> 
				<th>{{ trans("lectures3d.edit") }}</th> 
				<th>{{ trans("lectures3d.show") }}</th> 
				<th>{{
            trans("lectures3d.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->title , 20) }}</td> 
				<td> @include("website.lectures3d.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.lectures3d.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.lectures3d.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
