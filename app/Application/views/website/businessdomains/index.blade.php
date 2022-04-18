@extends(layoutExtend('website'))

@section('title')
     {{ trans('businessdomains.businessdomains') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.businessdomains') }}</h1></div>
     <div><a href="{{ url('businessdomains/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.businessdomains') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="domainname" class="form-control " placeholder="{{ trans("businessdomains.domainname") }}" value="{{ request()->has("domainname") ? request()->get("domainname") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("businessdomains.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("businessdomains.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("businessdomains.No") }} </option> 
			</select> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("businessdomains") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("businessdomains.domainname") }}</th> 
				<th>{{ trans("businessdomains.edit") }}</th> 
				<th>{{ trans("businessdomains.show") }}</th> 
				<th>{{
            trans("businessdomains.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->domainname , 20) }}</td> 
				<td> @include("website.businessdomains.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.businessdomains.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.businessdomains.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
