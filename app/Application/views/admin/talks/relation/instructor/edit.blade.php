		<div class="form-group {{ $errors->has("instructors") ? "has-error" : "" }}">
			<label for="instructors">{{ trans( "instructors.instructors") }}</label>
			@php $instructors = App\Application\Model\User::where('group_id',\App\Application\Model\User::TYPE_INSTRUCTOR)->pluck("name" ,"id")->all();
			@endphp
			@php  $instructor_id = isset($item) ? $item->instructor_id : null @endphp
			<select name="instructor_id"  class="form-control" >
			@foreach( $instructors as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $instructor_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("instructors"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("instructors") }}</strong>
					</span>
				</div>
			@endif
			</div>
