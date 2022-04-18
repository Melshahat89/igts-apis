		<div class="form-group {{ $errors->has("user") ? "has-error" : "" }}">
			<label for="user">{{ trans( "ticketsreplay.reciver_id") }}</label>
			@php $users = App\Application\Model\User::pluck("name" ,"id")->all()  @endphp
			@php  $reciver_id = isset($item) ? $item->reciver_id : null @endphp
			<select name="reciver_id"  class="form-control" >
			@foreach( $users as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $reciver_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("user"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("user") }}</strong>
					</span>
				</div>
			@endif
			</div>
