@extends(layoutExtend('website'))

@section('title')
     {{ trans('partnership.partnership') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.partnership') }}</h1></div>
     <div><a href="{{ url('partnership/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.partnership') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="setting" class="form-control " placeholder="{{ trans("partnership.setting") }}" value="{{ request()->has("setting") ? request()->get("setting") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("partnership") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("partnership.setting") }}</th> 
				<th>{{ trans("partnership.edit") }}</th> 
				<th>{{ trans("partnership.show") }}</th> 
				<th>{{
            trans("partnership.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->setting , 20) }}</td> 
				<td> @include("website.partnership.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.partnership.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.partnership.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
