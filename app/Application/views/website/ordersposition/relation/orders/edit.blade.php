		<div class="form-group {{ $errors->has("orders") ? "has-error" : "" }}">
			<label for="orders">{{ trans( "orders.orders") }}</label>
			@php $orders = App\Application\Model\Orders::pluck("id" ,"id")->all()  @endphp
			@php  $orders_id = isset($item) ? $item->orders_id : null @endphp
			<select name="orders_id"  class="form-control" >
			@foreach( $orders as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $orders_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("orders"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("orders") }}</strong>
					</span>
				</div>
			@endif
			</div>
