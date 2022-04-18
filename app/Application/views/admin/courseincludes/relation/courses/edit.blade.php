		<div class="form-group {{ $errors->has("courses") ? "has-error" : "" }}">
			<label for="courses">{{ trans( "courses.courses") }}</label>
			@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
			@php  $courses_id = isset($item) ? $item->courses_id : null @endphp
			<select name="courses_id"  class="form-control" >
			@foreach( $courses as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $courses_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("courses"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("courses") }}</strong>
					</span>
				</div>
			@endif
			</div>

			<div class="form-group {{ $errors->has("included_course") ? "has-error" : "" }}">
			<label for="included_course">Included Course</label>
			@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
			@php  $includedcourse_id = isset($item) ? $item->included_course : null @endphp
			<select name="included_course"  class="form-control" >
			@foreach( $courses as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $includedcourse_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("included_course"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("included_course") }}</strong>
					</span>
				</div>
			@endif
			</div>

			<div class="form-group {{ $errors->has("included_course_title") ? "has-error" : "" }}">
			<label for="included_course_title">Included Course Title</label>
				<input type="text" name="included_course_title" class="form-control" id="included_course_title" value="{{ isset($item->included_course_title) ? $item->included_course_title : old("included_course_title") }}"  placeholder="Included Course Title">
				@if ($errors->has("included_course_title"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("included_course_title") }}</strong>
					</span>
				</div>
			@endif
			</div>
			