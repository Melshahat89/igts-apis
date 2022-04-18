		<div class="form-group {{ $errors->has("user") ? "has-error" : "" }}">
			<label for="user">{{ trans( "user.user") }}</label>
			{{--  @php $users = App\Application\Model\User::pluck("name" ,"id")->all()  @endphp
			@php  $user_id = isset($item) ? $item->user_id : null @endphp
			<select name="user_id"  class="form-control" >
			@foreach( $users as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $user_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("user"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("user") }}</strong>
					</span>
				</div>
			@endif  --}}

			@php $user = App\Application\Model\User::find($item->user_id);  @endphp

			<label class="form-control" for="user">{{ is_json($user->name) ? getDefaultValueKey($user->name) :  $user->name}}</label>
				

			</div>
