@extends(layoutExtend('website'))

@section('title')
     {{ trans('careersresponses.careersresponses') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.careersresponses') }}</h1></div>
     <div><a href="{{ url('careersresponses/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.careersresponses') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("careersresponses.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="email" class="form-control " placeholder="{{ trans("careersresponses.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="mobile" class="form-control " placeholder="{{ trans("careersresponses.mobile") }}" value="{{ request()->has("mobile") ? request()->get("mobile") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("careersresponses") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("careersresponses.name") }}</th> 
				<th>{{ trans("careersresponses.edit") }}</th> 
				<th>{{ trans("careersresponses.show") }}</th> 
				<th>{{
            trans("careersresponses.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->name , 20) }}</td> 
				<td> @include("website.careersresponses.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.careersresponses.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.careersresponses.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
