@extends(layoutExtend('website'))

@section('title')
    {{ trans('becomeinstructor.becomeinstructor') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('becomeinstructor') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('becomeinstructor/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
			<label for="name">{{ trans("becomeinstructor.name")}}</label>
				<input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("becomeinstructor.name")}}">
		</div>
			@if ($errors->has("name"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("name") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
			<label for="email">{{ trans("becomeinstructor.email")}}</label>
				<input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("becomeinstructor.email")}}">
		</div>
			@if ($errors->has("email"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("email") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("phone") ? "has-error" : "" }}" > 
			<label for="phone">{{ trans("becomeinstructor.phone")}}</label>
				<input type="text" name="phone" class="form-control" id="phone" value="{{ isset($item->phone) ? $item->phone : old("phone") }}"  placeholder="{{ trans("becomeinstructor.phone")}}">
		</div>
			@if ($errors->has("phone"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("phone") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("title") ? "has-error" : "" }}" > 
			<label for="title">{{ trans("becomeinstructor.title")}}</label>
				<input type="text" name="title" class="form-control" id="title" value="{{ isset($item->title) ? $item->title : old("title") }}"  placeholder="{{ trans("becomeinstructor.title")}}">
		</div>
			@if ($errors->has("title"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("specialist") ? "has-error" : "" }}" > 
			<label for="specialist">{{ trans("becomeinstructor.specialist")}}</label>
				<input type="text" name="specialist" class="form-control" id="specialist" value="{{ isset($item->specialist) ? $item->specialist : old("specialist") }}"  placeholder="{{ trans("becomeinstructor.specialist")}}">
		</div>
			@if ($errors->has("specialist"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("specialist") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("yourCourses") ? "has-error" : "" }}" > 
			<label for="yourCourses">{{ trans("becomeinstructor.yourCourses")}}</label>
				<input type="text" name="yourCourses" class="form-control" id="yourCourses" value="{{ isset($item->yourCourses) ? $item->yourCourses : old("yourCourses") }}"  placeholder="{{ trans("becomeinstructor.yourCourses")}}">
		</div>
			@if ($errors->has("yourCourses"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("yourCourses") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("cv") ? "has-error" : "" }}" > 
			<label for="cv">{{ trans("becomeinstructor.cv")}}</label>
				@if(isset($item) && $item->cv != "")
				<br>
				<img src="{{ small($item->cv) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="cv" >
		</div>
			@if ($errors->has("cv"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("cv") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("socialAccount") ? "has-error" : "" }}" > 
			<label for="socialAccount">{{ trans("becomeinstructor.socialAccount")}}</label>
				<input type="text" name="socialAccount" class="form-control" id="socialAccount" value="{{ isset($item->socialAccount) ? $item->socialAccount : old("socialAccount") }}"  placeholder="{{ trans("becomeinstructor.socialAccount")}}">
		</div>
			@if ($errors->has("socialAccount"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("socialAccount") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.becomeinstructor') }}
                </button>
            </div>
        </form>
</div>
@endsection
