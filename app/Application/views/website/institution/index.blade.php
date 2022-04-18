@extends(layoutExtend('website'))

@section('title')
     {{ trans('institution.institution') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.institution') }}</h1></div>
     <div><a href="{{ url('institution/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.institution') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="temp1" class="form-control " placeholder="{{ trans("institution.temp1") }}" value="{{ request()->has("temp1") ? request()->get("temp1") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="temp2" class="form-control " placeholder="{{ trans("institution.temp2") }}" value="{{ request()->has("temp2") ? request()->get("temp2") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("institution") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("institution.temp1") }}</th> 
				<th>{{ trans("institution.edit") }}</th> 
				<th>{{ trans("institution.show") }}</th> 
				<th>{{
            trans("institution.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->temp1 , 20) }}</td> 
				<td> @include("website.institution.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.institution.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.institution.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
