@extends(layoutExtend('website'))

@section('title')
     {{ trans('masterrequest.masterrequest') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.masterrequest') }}</h1></div>
     <div><a href="{{ url('masterrequest/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.masterrequest') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="collage_name" class="form-control " placeholder="{{ trans("masterrequest.collage_name") }}" value="{{ request()->has("collage_name") ? request()->get("collage_name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="section" class="form-control " placeholder="{{ trans("masterrequest.section") }}" value="{{ request()->has("section") ? request()->get("section") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="g_year" class="form-control " placeholder="{{ trans("masterrequest.g_year") }}" value="{{ request()->has("g_year") ? request()->get("g_year") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="address" class="form-control " placeholder="{{ trans("masterrequest.address") }}" value="{{ request()->has("address") ? request()->get("address") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("masterrequest") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("masterrequest.qualification") }}</th> 
				<th>{{ trans("masterrequest.edit") }}</th> 
				<th>{{ trans("masterrequest.show") }}</th> 
				<th>{{
            trans("masterrequest.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
										 <td>
					 <img src="{{ small($d->qualification)}}"  width = "80" />
					 </td> 
<td> @include("website.masterrequest.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.masterrequest.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.masterrequest.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
