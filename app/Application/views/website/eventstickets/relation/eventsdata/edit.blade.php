		<div class="form-group {{ $errors->has("eventsdata") ? "has-error" : "" }}">
			<label for="eventsdata">{{ trans( "eventsdata.eventsdata") }}</label>
			@php $eventsdatas = App\Application\Model\Eventsdata::pluck("name" ,"id")->all()  @endphp
			@php  $eventsdata_id = isset($item) ? $item->eventsdata_id : null @endphp
			<select name="eventsdata_id"  class="form-control" >
			@foreach( $eventsdatas as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $eventsdata_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("eventsdata"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("eventsdata") }}</strong>
					</span>
				</div>
			@endif
			</div>
