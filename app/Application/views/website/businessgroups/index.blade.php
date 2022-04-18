@extends(layoutExtend('website'))

@section('title')
     {{ trans('businessgroups.businessgroups') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.businessgroups') }}</h1></div>
     <div><a href="{{ url('businessgroups/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.businessgroups') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("businessgroups.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="parent_id" class="form-control " placeholder="{{ trans("businessgroups.parent_id") }}" value="{{ request()->has("parent_id") ? request()->get("parent_id") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("businessgroups") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("businessgroups.name") }}</th> 
				<th>{{ trans("businessgroups.edit") }}</th> 
				<th>{{ trans("businessgroups.show") }}</th> 
				<th>{{
            trans("businessgroups.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->name , 20) }}</td> 
				<td> @include("website.businessgroups.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.businessgroups.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.businessgroups.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
