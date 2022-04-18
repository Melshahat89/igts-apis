@extends(layoutExtend('website'))

@section('title')
     {{ trans('promotionusers.promotionusers') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.promotionusers') }}</h1></div>
     <div><a href="{{ url('promotionusers/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.promotionusers') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group" > 
			<select style="width:80px;" name="used" class="form-control select2" placeholder="{{ trans("promotionusers.used") }}" > 
				<option value="1" {{ request()->has("used") && request()->get("used") === 1 ? "selected" : "" }}>{{trans("promotionusers.Yes") }} </option> 
				<option value="0" {{request()->has("used") && request()->get("used") === 0 ? "selected" : "" }}>{{trans("promotionusers.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("promotionusers") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("promotionusers.used") }}</th> 
				<th>{{ trans("promotionusers.edit") }}</th> 
				<th>{{ trans("promotionusers.show") }}</th> 
				<th>{{
            trans("promotionusers.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
				{{ $d->used == 1 ? trans("promotionusers.Yes") : trans("promotionusers.No")  }}
					 </td> 
<td> @include("website.promotionusers.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.promotionusers.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.promotionusers.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
