		<div class="form-group {{ $errors->has("tickets") ? "has-error" : "" }}">
			<label for="tickets">{{ trans( "tickets.tickets") }}</label>
			@php $tickets = App\Application\Model\Tickets::pluck("title" ,"id")->all()  @endphp
			@php  $tickets_id = isset($item) ? $item->tickets_id : null @endphp
			<select name="tickets_id"  class="form-control" >
			@foreach( $tickets as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $tickets_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("tickets"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("tickets") }}</strong>
					</span>
				</div>
			@endif
			</div>
