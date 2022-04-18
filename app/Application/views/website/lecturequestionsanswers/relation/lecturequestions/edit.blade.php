		<div class="form-group {{ $errors->has("lecturequestions") ? "has-error" : "" }}">
			<label for="lecturequestions">{{ trans( "lecturequestions.lecturequestions") }}</label>
			@php $lecturequestions = App\Application\Model\Lecturequestions::pluck("question_title" ,"id")->all()  @endphp
			@php  $lecturequestions_id = isset($item) ? $item->lecturequestions_id : null @endphp
			<select name="lecturequestions_id"  class="form-control" >
			@foreach( $lecturequestions as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $lecturequestions_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("lecturequestions"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("lecturequestions") }}</strong>
					</span>
				</div>
			@endif
			</div>
