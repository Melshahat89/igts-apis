		<div class="form-group {{ $errors->has("promotions") ? "has-error" : "" }}">
			<label for="promotions">{{ trans( "promotions.promotions") }}</label>
			@php $promotions = App\Application\Model\Promotions::pluck("title" ,"id")->all()  @endphp
			@php  $promotions_id = isset($item) ? $item->promotions_id : null @endphp
			<select name="promotions_id"  class="form-control" >
			@foreach( $promotions as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $promotions_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("promotions"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("promotions") }}</strong>
					</span>
				</div>
			@endif
			</div>
