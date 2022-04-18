@extends(layoutExtend('website'))

@section('title')
     {{ trans('partners.partners') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.partners') }}</h1></div>
     <div><a href="{{ url('partners/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.partners') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("partners.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("partners.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="seo_desc" class="form-control " placeholder="{{ trans("partners.seo_desc") }}" value="{{ request()->has("seo_desc") ? request()->get("seo_desc") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="seo_keys" class="form-control " placeholder="{{ trans("partners.seo_keys") }}" value="{{ request()->has("seo_keys") ? request()->get("seo_keys") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="search_keys" class="form-control " placeholder="{{ trans("partners.search_keys") }}" value="{{ request()->has("search_keys") ? request()->get("search_keys") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("partners") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("partners.title") }}</th> 
				<th>{{ trans("partners.edit") }}</th> 
				<th>{{ trans("partners.show") }}</th> 
				<th>{{
            trans("partners.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.partners.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.partners.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.partners.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
