@extends(layoutExtend('website'))

@section('title')
     {{ trans('coursewishlist.coursewishlist') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.coursewishlist') }}</h1></div>
     <div><a href="{{ url('coursewishlist/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.coursewishlist') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="note" class="form-control " placeholder="{{ trans("coursewishlist.note") }}" value="{{ request()->has("note") ? request()->get("note") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("coursewishlist") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("coursewishlist.note") }}</th> 
				<th>{{ trans("coursewishlist.edit") }}</th> 
				<th>{{ trans("coursewishlist.show") }}</th> 
				<th>{{
            trans("coursewishlist.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->note , 20) }}</td> 
				<td> @include("website.coursewishlist.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.coursewishlist.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.coursewishlist.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
