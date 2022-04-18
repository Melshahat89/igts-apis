@extends(layoutExtend('website'))

@section('title')
     {{ trans('promotionactive.promotionactive') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.promotionactive') }}</h1></div>
     <div><a href="{{ url('promotionactive/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.promotionactive') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("promotionactive.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("promotionactive.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("promotionactive.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("promotionactive") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("promotionactive.status") }}</th> 
				<th>{{ trans("promotionactive.edit") }}</th> 
				<th>{{ trans("promotionactive.show") }}</th> 
				<th>{{
            trans("promotionactive.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
				{{ $d->status == 1 ? trans("promotionactive.Yes") : trans("promotionactive.No")  }}
					 </td> 
<td> @include("website.promotionactive.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.promotionactive.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.promotionactive.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
