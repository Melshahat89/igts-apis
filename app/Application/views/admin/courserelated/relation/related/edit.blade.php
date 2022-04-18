		<div class="form-group {{ $errors->has("courses") ? "has-error" : "" }}">
			<label for="courses">{{ trans( "courses.courses") }}</label>
			@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
			@php  $related_course_id = isset($item) ? $item->related_course_id : null @endphp
			<select name="related_course_id"  class="form-control" >
			@foreach( $courses as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $related_course_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
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
