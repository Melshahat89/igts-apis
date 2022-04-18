@extends(layoutExtend('website'))

@section('title')
     {{ trans('talksrelated.talksrelated') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.talksrelated') }}</h1></div>
     <div><a href="{{ url('talksrelated/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.talksrelated') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="position" class="form-control " placeholder="{{ trans("talksrelated.position") }}" value="{{ request()->has("position") ? request()->get("position") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("talksrelated") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("talksrelated.position") }}</th> 
				<th>{{ trans("talksrelated.edit") }}</th> 
				<th>{{ trans("talksrelated.show") }}</th> 
				<th>{{
            trans("talksrelated.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->position , 20) }}</td> 
				<td> @include("website.talksrelated.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.talksrelated.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.talksrelated.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
