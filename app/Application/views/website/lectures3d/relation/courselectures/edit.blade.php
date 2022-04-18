		<div class="form-group {{ $errors->has("courselectures") ? "has-error" : "" }}">
			<label for="courselectures">{{ trans( "courselectures.courselectures") }}</label>
			@php $courselectures = App\Application\Model\Courselectures::pluck("title" ,"id")->all()  @endphp
			@php  $courselectures_id = isset($item) ? $item->courselectures_id : null @endphp
			<select name="courselectures_id"  class="form-control" >
			@foreach( $courselectures as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $courselectures_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("courselectures"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("courselectures") }}</strong>
					</span>
				</div>
			@endif
			</div>
