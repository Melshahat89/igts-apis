		<div class="form-group {{ $errors->has("talks") ? "has-error" : "" }}">
			<label for="talks">{{ trans( "talks.talks") }}</label>
			@php $talks = App\Application\Model\Talks::pluck("title" ,"id")->all()  @endphp
			@php  $talks_id = isset($item) ? $item->talks_id : null @endphp
			<select name="talks_id"  class="form-control" >
			@foreach( $talks as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $talks_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("talks"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("talks") }}</strong>
					</span>
				</div>
			@endif
			</div>
