@extends(layoutExtend('website'))

@section('title')
     {{ trans('talklikes.talklikes') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.talklikes') }}</h1></div>
     <div><a href="{{ url('talklikes/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.talklikes') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="comment" class="form-control " placeholder="{{ trans("talklikes.comment") }}" value="{{ request()->has("comment") ? request()->get("comment") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("talklikes.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("talklikes.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("talklikes.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("talklikes") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("talklikes.comment") }}</th> 
				<th>{{ trans("talklikes.edit") }}</th> 
				<th>{{ trans("talklikes.show") }}</th> 
				<th>{{
            trans("talklikes.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->comment , 20) }}</td> 
				<td> @include("website.talklikes.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.talklikes.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.talklikes.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
