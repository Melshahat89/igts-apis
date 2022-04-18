		<div class="form-group {{ $errors->has("payments") ? "has-error" : "" }}">
			<label for="payments">{{ trans( "payments.payments") }}</label>
			@php $payments = App\Application\Model\Payments::pluck("id" ,"id")->all()  @endphp
			@php  $payments_id = isset($item) ? $item->payments_id : null @endphp
			<select name="payments_id"  class="form-control" >
			@foreach( $payments as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $payments_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("payments"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("payments") }}</strong>
					</span>
				</div>
			@endif
			</div>
