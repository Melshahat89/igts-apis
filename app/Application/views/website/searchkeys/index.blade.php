@extends(layoutExtend('website'))

@section('title')
     {{ trans('searchkeys.searchkeys') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.searchkeys') }}</h1></div>
     <div><a href="{{ url('searchkeys/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.searchkeys') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="word" class="form-control " placeholder="{{ trans("searchkeys.word") }}" value="{{ request()->has("word") ? request()->get("word") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="ip" class="form-control " placeholder="{{ trans("searchkeys.ip") }}" value="{{ request()->has("ip") ? request()->get("ip") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="country" class="form-control " placeholder="{{ trans("searchkeys.country") }}" value="{{ request()->has("country") ? request()->get("country") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="city" class="form-control " placeholder="{{ trans("searchkeys.city") }}" value="{{ request()->has("city") ? request()->get("city") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("searchkeys") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("searchkeys.word") }}</th> 
				<th>{{ trans("searchkeys.edit") }}</th> 
				<th>{{ trans("searchkeys.show") }}</th> 
				<th>{{
            trans("searchkeys.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->word , 20) }}</td> 
				<td> @include("website.searchkeys.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.searchkeys.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.searchkeys.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
