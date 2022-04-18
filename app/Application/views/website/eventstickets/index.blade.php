@extends(layoutExtend('website'))

@section('title')
     {{ trans('eventstickets.eventstickets') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.eventstickets') }}</h1></div>
     <div><a href="{{ url('eventstickets/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.eventstickets') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("eventstickets.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="email" class="form-control " placeholder="{{ trans("eventstickets.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="code" class="form-control " placeholder="{{ trans("eventstickets.code") }}" value="{{ request()->has("code") ? request()->get("code") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("eventstickets") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("eventstickets.name") }}</th> 
				<th>{{ trans("eventstickets.edit") }}</th> 
				<th>{{ trans("eventstickets.show") }}</th> 
				<th>{{
            trans("eventstickets.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->name , 20) }}</td> 
				<td> @include("website.eventstickets.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.eventstickets.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.eventstickets.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
