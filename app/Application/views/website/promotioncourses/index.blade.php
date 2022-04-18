@extends(layoutExtend('website'))

@section('title')
     {{ trans('promotioncourses.promotioncourses') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.promotioncourses') }}</h1></div>
     <div><a href="{{ url('promotioncourses/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.promotioncourses') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="note" class="form-control " placeholder="{{ trans("promotioncourses.note") }}" value="{{ request()->has("note") ? request()->get("note") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("promotioncourses") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("promotioncourses.note") }}</th> 
				<th>{{ trans("promotioncourses.edit") }}</th> 
				<th>{{ trans("promotioncourses.show") }}</th> 
				<th>{{
            trans("promotioncourses.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->note , 20) }}</td> 
				<td> @include("website.promotioncourses.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.promotioncourses.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.promotioncourses.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
