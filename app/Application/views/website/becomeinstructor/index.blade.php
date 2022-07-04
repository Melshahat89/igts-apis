@extends(layoutExtend('website'))

@section('title')
     {{ trans('becomeinstructor.becomeinstructor') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.becomeinstructor') }}</h1></div>
     <div><a href="{{ url('becomeinstructor/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.becomeinstructor') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="name" class="form-control " placeholder="{{ trans("becomeinstructor.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="email" class="form-control " placeholder="{{ trans("becomeinstructor.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="phone" class="form-control " placeholder="{{ trans("becomeinstructor.phone") }}" value="{{ request()->has("phone") ? request()->get("phone") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("becomeinstructor.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="specialist" class="form-control " placeholder="{{ trans("becomeinstructor.specialist") }}" value="{{ request()->has("specialist") ? request()->get("specialist") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="yourCourses" class="form-control " placeholder="{{ trans("becomeinstructor.yourCourses") }}" value="{{ request()->has("yourCourses") ? request()->get("yourCourses") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="socialAccount" class="form-control " placeholder="{{ trans("becomeinstructor.socialAccount") }}" value="{{ request()->has("socialAccount") ? request()->get("socialAccount") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("becomeinstructor") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("becomeinstructor.name") }}</th> 
				<th>{{ trans("becomeinstructor.edit") }}</th> 
				<th>{{ trans("becomeinstructor.show") }}</th> 
				<th>{{
            trans("becomeinstructor.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->name , 20) }}</td> 
				<td> @include("website.becomeinstructor.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.becomeinstructor.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.becomeinstructor.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection
