@extends(layoutExtend('website'))

@section('title')
     {{ trans('businessgroupsusers.businessgroupsusers') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.businessgroupsusers') }}</h1></div>
     <div><a href="{{ url('businessgroupsusers/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.businessgroupsusers') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("businessgroupsusers.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("businessgroupsusers.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("businessgroupsusers.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="note" class="form-control " placeholder="{{ trans("businessgroupsusers.note") }}" value="{{ request()->has("note") ? request()->get("note") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("businessgroupsusers") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("businessgroupsusers.status") }}</th> 
				<th>{{ trans("businessgroupsusers.edit") }}</th> 
				<th>{{ trans("businessgroupsusers.show") }}</th> 
				<th>{{
            trans("businessgroupsusers.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
				{{ $d->status == 1 ? trans("businessgroupsusers.Yes") : trans("businessgroupsusers.No")  }}
					 </td> 
<td> @include("website.businessgroupsusers.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.businessgroupsusers.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.businessgroupsusers.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
