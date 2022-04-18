		<div class="form-group {{ $errors->has("careers") ? "has-error" : "" }}">
			<label for="careers">{{ trans( "careers.careers") }}</label>
			@php $careers = App\Application\Model\Careers::pluck("title" ,"id")->all()  @endphp
			@php  $careers_id = isset($item) ? $item->careers_id : null @endphp
			<select name="careers_id"  class="form-control" >
			@foreach( $careers as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $careers_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("careers"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("careers") }}</strong>
					</span>
				</div>
			@endif
			</div>
