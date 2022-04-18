@extends(layoutExtend('website'))

@section('title')
     {{ trans('social.social') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.social') }}</h1></div>
     <div><a href="{{ url('social/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.social') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="user_id" class="form-control " placeholder="{{ trans("social.user_id") }}" value="{{ request()->has("user_id") ? request()->get("user_id") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="provider" class="form-control " placeholder="{{ trans("social.provider") }}" value="{{ request()->has("provider") ? request()->get("provider") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="identifier" class="form-control " placeholder="{{ trans("social.identifier") }}" value="{{ request()->has("identifier") ? request()->get("identifier") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="profile_cache" class="form-control " placeholder="{{ trans("social.profile_cache") }}" value="{{ request()->has("profile_cache") ? request()->get("profile_cache") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="session_data" class="form-control " placeholder="{{ trans("social.session_data") }}" value="{{ request()->has("session_data") ? request()->get("session_data") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("social") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("social.user_id") }}</th> 
				<th>{{ trans("social.edit") }}</th> 
				<th>{{ trans("social.show") }}</th> 
				<th>{{
            trans("social.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->user_id , 20) }}</td> 
				<td> @include("website.social.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.social.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.social.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
