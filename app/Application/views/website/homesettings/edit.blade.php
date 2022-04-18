@extends(layoutExtend('website'))

@section('title')
    {{ trans('homesettings.homesettings') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('homesettings') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('homesettings/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("bundles") ? "has-error" : "" }}" > 
			<label for="bundles">{{ trans("homesettings.bundles")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="bundles" {{ isset($item->bundles) && $item->bundles == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("homesettings.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="bundles" {{ isset($item->bundles) && $item->bundles == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("homesettings.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("bundles"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("bundles") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("featured_courses") ? "has-error" : "" }}" > 
			<label for="featured_courses">{{ trans("homesettings.featured_courses")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="featured_courses" {{ isset($item->featured_courses) && $item->featured_courses == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("homesettings.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="featured_courses" {{ isset($item->featured_courses) && $item->featured_courses == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("homesettings.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("featured_courses"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("featured_courses") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("events") ? "has-error" : "" }}" > 
			<label for="events">{{ trans("homesettings.events")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="events" {{ isset($item->events) && $item->events == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("homesettings.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="events" {{ isset($item->events) && $item->events == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("homesettings.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("events"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("events") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("talks") ? "has-error" : "" }}" > 
			<label for="talks">{{ trans("homesettings.talks")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="talks" {{ isset($item->talks) && $item->talks == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("homesettings.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="talks" {{ isset($item->talks) && $item->talks == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("homesettings.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("talks"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("talks") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.homesettings') }}
                </button>
            </div>
        </form>
</div>
@endsection
