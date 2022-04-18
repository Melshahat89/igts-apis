		<div class="form-group {{ $errors->has("businessgroups") ? "has-error" : "" }}">
			<label for="businessgroups">{{ trans( "businessgroups.businessgroups") }}</label>
			@php $businessgroups = App\Application\Model\Businessgroups::pluck("name" ,"id")->all()  @endphp
			@php  $businessgroups_id = isset($item) ? $item->businessgroups_id : null @endphp
			<select name="businessgroups_id"  class="form-control" >
			@foreach( $businessgroups as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $businessgroups_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("businessgroups"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("businessgroups") }}</strong>
					</span>
				</div>
			@endif
			</div>
